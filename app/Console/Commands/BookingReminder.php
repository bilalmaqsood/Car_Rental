<?php

namespace Qwikkar\Console\Commands;

use Carbon\Carbon;
use Qwikkar\Models\Booking;
use Illuminate\Console\Command;
use Qwikkar\Events\BookingUnsuccessfull;
use Qwikkar\Notifications\BookingNotify;


class BookingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder to owner and driver if booking is pending';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bookings = Booking::BookingRequests()->with("reminders")->get();

        $this->remindeDriver($bookings);
        $this->remindeOwner($bookings);
        $this->inspectionReminder();
    }

    /**
     * @param $bookings
     */
    public function remindeDriver($bookings){
        foreach ($bookings as $booking){
            $owner = $booking->vehicle->owner->user;
            $client = $booking->user;
            $reminder_count = $booking->reminders()->where("client_id", $client->id)->count()+1;
            $date = Carbon::now();
            $diff = $date->diffInMinutes($booking->created_at); // return time in minute
            $required_time = $reminder_count * DRIVER_REMINDER_INTERVAL;
//                d($diff);
//                dd($required_time);
            if($diff >= $required_time) {


                // if ($reminder_count > BOOKING_REMINDER_ATTEMPTS_LIMIT)
                //     event(new BookingUnsuccessfull($booking));
                // else {
                    
                    $booking->user->notify(new BookingNotify([
                        'id' => $booking->id,
                        'type' => 'Booking',
                        'status' => BOOKING_PENDING,
                        'old_status' => BOOKING_PENDING,
                        'interval' => DRIVER_REMINDER_INTERVAL,
                        'vehicle_id' => $booking->vehicle->id,
                        'image' => $booking->vehicle->images->first(),
                        'title' => 'Booking request pending',
                        'user' => $owner->name,
                        'vehicle' => $booking->vehicle->vehicle_name,
                        'contract_start' => $booking->start_date,
                        'contract_end' => $booking->end_date,
                    ]));

                    $booking->reminders()->create([
                        "owner_id" => null,
                        "client_id" => $client->id
                    ]);

                // }

            }
        }
    }

    public function remindeOwner($bookings){
        foreach ($bookings as $booking){
            $owner_id = $booking->vehicle->owner->user->id;
            $client_id = $booking->user->id;
            $reminder_count = $booking->reminders()->where("owner_id", $owner_id)->count()+1;
            $date = Carbon::now();
            $diff = $date->diffInMinutes($booking->created_at); // return time in minute
            $required_time = $reminder_count * OWNER_REMINDER_INTERVAL;
//                d($diff);
//                dd($required_time);
            if($diff >= $required_time) {


                if ($reminder_count > BOOKING_REMINDER_ATTEMPTS_LIMIT)
                    event(new BookingUnsuccessfull($booking));
                else {
                    $booking->vehicle->owner->user->notify(new BookingNotify([
                        'id' => $booking->id,
                        'type' => 'Booking',
                        'status' => BOOKING_PENDING,
                        'old_status' => BOOKING_PENDING,
                        'vehicle_id' => $booking->vehicle->id,
                        'image' => $booking->vehicle->images->first(),
                        'title' => 'Booking request pending',
                        'user' => $booking->user->name,
                        'vehicle' => $booking->vehicle->vehicle_name,
                        'contract_start' => $booking->start_date,
                        'contract_end' => $booking->end_date,
                    ]));

                    $booking->reminders()->create([
                        "owner_id" => $owner_id,
                        "client_id" => null
                    ]);

                }

            }
        }
    }

    public function inspectionReminder($value='')
    {

        Booking::where('start_date',"<",Carbon::now()->addHours(24)->format("Y-m-d"))->
                 whereIn("status",[2,3])->whereNull("inspection_open")->chunk(20, function ($bookings) {
            foreach ($bookings as $booking) {

                $notificationData = [
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => INSPECTION_OPEN,
                'old_status' => $booking->status,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Handerover Inspection is available',
                'user' => $booking->vehicle->owner->user->name,
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


                $booking->vehicle->owner->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));
                $booking->inspection_open = Carbon::now();
                $booking->save();
            }
        });

    }
}
