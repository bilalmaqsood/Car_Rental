<?php

namespace Qwikkar\Http\Controllers\API;

use Qwikkar\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Qwikkar\Models\ContractTemplate;
use Qwikkar\Concerns\BookingOperations;
use Qwikkar\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContractController extends Controller
{
    use BookingOperations;

    /**
     * ContractController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner')->only([
            'getContractTemplate',
            'contractTemplate',
            'contractSignature',
        ]);

        $this->middleware('not-admin')->only('contractBooking');
    }

    /**
     * Get contract template for vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getContractTemplate(Request $request, $id)
    {
        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        if (!$vehicle) throw new ModelNotFoundException();

        $vehicle->contractTemplate()->update([
                'template' => File::get(resource_path('stubs/contract-template.stub'))
            ]);

        return response($vehicle->contractTemplate ? $vehicle->contractTemplate->template : '')->header('Content-Type', 'text/plain');
    }

    /**
     * Add contract template for vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function contractTemplate(Request $request, $id)
    {
        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        $contractTemplate = $vehicle->contractTemplate;
        if (!$contractTemplate)
            $contractTemplate = new ContractTemplate();

        $contractTemplate->template = $request->getContent();

        if ($vehicle->contractTemplate)
            $contractTemplate->save();
        else
            $vehicle->contractTemplate()->save($contractTemplate);

        return api_response(trans('vehicle.contract.added', ['vehicle' => $vehicle->vehicle_name]));
    }

    /**
     * Add contract template for vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function contractSignature(Request $request, $id)
    {
        $this->validate($request, [
            'signature' => 'required|string'
        ]);

        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        $contractTemplate = $vehicle->contractTemplate;
        if (!$contractTemplate)
            $contractTemplate = new ContractTemplate();

        $contractTemplate->owner_signature = $request->signature;

        if ($vehicle->contractTemplate)
            $contractTemplate->save();
        else
            $vehicle->contractTemplate()->save($contractTemplate);

        return api_response(trans('vehicle.contract.signature', ['vehicle' => $vehicle->vehicle_name]));
    }

    /**
     * Return contract of booking rather than pdf file
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contractBooking($id)
    {
        $booking = Booking::findOrFail($id);

        return view('pdf.contract', [
            'driver_signature' => $booking->signatures ? $booking->signatures->get('client') : '',
            'owner_signature' => $booking->signatures ? $booking->signatures->get('owner') : '',
            'content' => $this->compileTemplate($booking),
            'webView' => true
        ]);
    }


    public function contractData($booking_id)
    {
        $data = $this->getContractData($booking_id);

        return api_response($data);
    }

    public function updateContractData(Request $request,$booking_id)
    {
       $booking = Booking::find($booking_id);
        if(!$booking)
            return api_response(trans('booking.unauthenticated', ['name' => request()->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);
        
        $result = $booking->contract()->update($request->all());

        if($result)
            return api_response(trans('booking.contract-save'));
    }

    public function previewContract(Request $request, $booking_id){

     $booking = Booking::find($booking_id);
        if(!$booking)
            return api_response(trans('booking.unauthenticated', ['name' => request()->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);
        
        $result = $booking->contract()->update($request->all());

        if($result)
            $path = $this->updateContractTemplate($booking);

        return api_response(["path" => $path,"title" => "Rent Agreement","type" => "pdf"]);

    }

}
