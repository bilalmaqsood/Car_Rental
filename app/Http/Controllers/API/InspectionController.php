<?php

namespace Qwikkar\Http\Controllers\API;

use Qwikkar\Models\Vehicle;
use Qwikkar\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Models\Inspection;
use Qwikkar\Concerns\Disputable;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Notifications\BookingNotify;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class InspectionController extends Controller
{
    use Disputable;

    /**
     * InspectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner')->except(['index','lastInspection','confirmInspection','amendedInspection','notifyAmendedInspection']);

        $this->middleware('not-admin')->only(['index','lastInspection','confirmInspection']);
    }

    /**
     * Get all inspections of a booking
     *
     * @param $booking_id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        return api_response($booking->vehicle->inspection);
    }

    /**
     * add an inspection of a booking
     *
     * @param Request $request
     * @param $booking_id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $booking_id)
    {
        $this->validate($request, [
            'data' => 'required|array|min:1',
            'data.*.type' => 'required|in:front,rear,driver_side,off_side,notes',
            'data.*.status' => 'in:0,1',
            'data.*.is_return' => 'boolean',
            // 'data.*.x_axis' => 'numeric',
            // 'data.*.y_axis' => 'numeric',
            'data.*.path' => 'string',
            'data.*.note' => 'string',
        ]);
        $data = collect($request->data)->first();
        
        $booking = Booking::findOrFail($booking_id);
        if ($booking->status < 4 && $data['is_return'])
            return api_response(trans('booking.return'), Response::HTTP_CONFLICT);
        
        if ($booking->status >= 4 && !$data['is_return'])
            return api_response(trans('booking.handover'), Response::HTTP_CONFLICT);

        $spots = collect($request->data)
            ->map(function ($spot) use ($request, $booking) {

                $inspection = Inspection::firstOrNew(collect($spot)->only('x_axis', 'y_axis', 'path')->all());

                if (!$inspection->exists) {
                    $inspection->fill($spot);
                    $inspection->vehicle()->associate($booking->vehicle);
                    $inspection->booking()->associate($booking);
                    $inspection->save();

                    return $inspection;
                }
            })
            ->reject(function ($spot) {
                return $spot == null;
            })
            ->values();

        if ($spots->count() && isset($data['status']) && $data['status'] == 1 && $booking->status != 10) {

            $this->openDispute($request, $booking, $spots->first());

            $booking->user->client->update(['status' => 1]);

            $booking->update(['status' => 10]);
        }

        return api_response(trans('booking.inspection_added', ['count' => $spots->count()]));
    }

    /**
     * Get an inspection of a booking
     *
     * @param $booking_id
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function show($booking_id, $id)
    {
        $booking = Booking::findOrFail($booking_id);

        $inspection = $booking->vehicle->inspection()->where('id', $id)->first();

        if (!$inspection) throw new ModelNotFoundException();

        return api_response($inspection);
    }

    /**
     * Update an inspection of a booking
     *
     * @param Request $request
     * @param $booking_id
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $booking_id, $id)
    {
        $this->validate($request, [
            'type' => 'required|in:front,rear,driver_side,off_side,notes',
            'status' => 'in:0,1',
            'is_return' => 'boolean',
            'x_axis' => 'numeric',
            'y_axis' => 'numeric',
            'path' => 'string',
            'note' => 'string',
        ]);

         $data = request()->all();

        $booking = Booking::findOrFail($booking_id);

        $inspection = $booking->vehicle->inspection()->where('id', $id)->first();

        if (!$inspection) throw new ModelNotFoundException();

        if ($booking->status < 4 && $data['is_return'])
            return api_response(trans('booking.return'), Response::HTTP_CONFLICT);

        if ($booking->status >= 4 && !$data['is_return'])
            return api_response(trans('booking.handover'), Response::HTTP_CONFLICT);

        $inspection->fill($request->all());
        $inspection->booking()->associate($booking);
        $inspection->save();

        if (isset($data['status']) && $data['status'] == 1 && $booking->status != 10) {

            $this->openDispute($request, $booking, $inspection);

            $booking->user->client->update(['status' => 1]);

            $booking->update(['status' => 10]);
        }

        return api_response($inspection);
    }

    /**
     * Destroy an inspection of a booking
     *
     * @param $booking_id
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy($booking_id, $id)
    {
        $booking = Booking::findOrFail($booking_id);

        $inspection = $booking->vehicle->inspection()->where('id', $id)->first();

        if (!$inspection) throw new ModelNotFoundException();

        return api_response($inspection->delete());
    }


    /**
     * Show last inspection
     *
     * @param $vehicle_id
     * @return array|\Illuminate\Http\JsonResponse
     */

    public function lastInspection($vehicle_id){

        $vehicle = Vehicle::find($vehicle_id);

        $inspection = $vehicle->inspection;
            
        if (!$inspection) throw new ModelNotFoundException();

        return api_response($inspection);  
    }

    public function notifyDriver( Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        // if(!$booking->code())
        //     $booking->code()->create([
        //         'confirm_code' => mt_rand(1000, 9999),
        //          'status' => 0
        //         ]);

        $booking->user->notify(new BookingNotify([
            'id' => $booking->id,
            'type' => 'Booking',
            'status' => INSPECTION_COMPLETED,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => 'Owner updated vehicle inspection',
            'user' => $request->user()->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
        ]));

        
       
    }

    public function notifyAmendedInspection( Request $request, $booking_id)
    {

        $booking = Booking::findOrFail($booking_id);

        if($booking)
        $booking->vehicle->owner->user->notify(new BookingNotify([
            'id' => $booking->id,
            'type' => 'Booking',
            'status' => BOOKING_AMENDED,
            'old_status' => BOOKING_AMENDED,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => 'Inspection needs ammendment',
            'user' => $request->user()->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
        ]));

    }

    public function amendedInspection(Request $request, $booking_id){

          $this->validate($request, [
            'data' => 'required|array|min:1',
            'data.*.type' => 'required|in:front,rear,driver_side,off_side,notes',
            'data.*.status' => 'in:0,1,'.BOOKING_AMENDED,
            'data.*.is_return' => 'boolean',
            // 'data.*.x_axis' => 'numeric',
            // 'data.*.y_axis' => 'numeric',
            'data.*.path' => 'string',
            'data.*.note' => 'string',
        ]);

        $data = collect($request->data)->first();
        
        $booking = Booking::findOrFail($booking_id);

        if ($booking->status >= 4 )
            return api_response('Cannot do amended inspection at the moment', Response::HTTP_CONFLICT);

        $spots = collect($request->data)
            ->map(function ($spot) use ($request, $booking) {

                $inspection = Inspection::firstOrNew(collect($spot)->only('x_axis', 'y_axis', 'path')->all());

                if (!$inspection->exists) {
                    $inspection->fill($spot);
                    $inspection->vehicle()->associate($booking->vehicle);
                    $inspection->booking()->associate($booking);
                    $inspection->status = BOOKING_AMENDED;
                    
                    $inspection->save();

                    return $inspection;
                }
            })
            ->reject(function ($spot) {
                return $spot == null;
            })
            ->values();

        return api_response(trans('booking.inspection_added', ['count' => $spots->count()]));
    }

    public function confirmInspection(Request $request,$booking_id)
    { 
        $this->validate($request, [
            'inspection_code' => 'required|numeric',
            
        ]);

        $booking = Booking::findOrFail($booking_id);

        $result =  $booking->code()->where("confirm_code",$request->inspection_code);

        if($result->count()){
             $booking->update(["status" => BOOKING_ACTIVE]);

             //Send notifications
             $receiver = $request->user()->id == $booking->user->id ? $booking->vehicle->owner->user : $booking->user;
              $notificationData = [
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => INSPECTION_CONFIRMED,
                'old_status' => $booking->status,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Inspection Confirmed',
                'user' => $request->user()->name,
                'credit_card' => $booking->account?$booking->account->last_numbers:'',
                'vehicle' => $booking->vehicle->vehicle_name,
                'contract_start' => $booking->start_date,
                'contract_end' => $booking->end_date,
                'deposit' => $booking->deposit,
                'signatures' => [
                    'owner' => $booking->signatures && $booking->signatures->has('owner'),
                    'client' => $booking->signatures && $booking->signatures->has('client')
                ]
            ];

            $receiver->notify((new BookingNotify($notificationData))->delay(\Carbon\Carbon::now()->addMinute()));



            return api_response(trans('booking.inspection_confirmed'));
        }

        return api_response(trans('booking.inspection_code_notfound'),404);

    }

    public function approveInspection($booking_id,$spot_id)
    {

        $booking = Booking::findOrFail($booking_id);

        $spot =  $booking->inspections()->whereId($spot_id);
        $spot->update(["status"=>0]);
        
        return api_response($spot->first()->fresh());
    }

    public function resolveDisputedSpot($booking_id,$spot_id)
    {
        $booking = Booking::findOrFail($booking_id);
         
        $total_disputed_points =  $booking->inspections()->where("status",1)->where("type","!=","notes")->count();

        if($total_disputed_points)
        {
          $spot =  $booking->inspections()->whereId($spot_id);
          $spot->update(["status"=>0]); 

          if($total_disputed_points-1==0){
           $this->disputionResolveNotification($booking); 
            $booking->update(["status"=>BOOKING_DISPUTE_RESOLVED]);
            $booking->user->client->update(['status' => 0]);
          }

        }

        return api_response($spot->first()->fresh());
         
    }

    public function disputionResolveNotification($booking)
    {
        $receiver = $booking->user;

             $notificationData = [
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => DISPUTED_RESOLVED,
                'old_status' => $booking->status,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Vehicle disputed resolved',
                'user' => request()->user()->name,
                'credit_card' => $booking->account?$booking->account->last_numbers:'',
                'vehicle' => $booking->vehicle->vehicle_name,
                'contract_start' => $booking->start_date,
                'contract_end' => $booking->end_date,
                'deposit' => $booking->deposit,
                'signatures' => [
                    'owner' => $booking->signatures && $booking->signatures->has('owner'),
                    'client' => $booking->signatures && $booking->signatures->has('client')
                ]
            ];

            $receiver->notify((new BookingNotify($notificationData))->delay(\Carbon\Carbon::now()->addMinute()));

    }
}
