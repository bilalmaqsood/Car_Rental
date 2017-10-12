<?php

namespace Qwikkar\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Booking;
use Qwikkar\Notifications\BookingNotify;
use Qwikkar\Notifications\RatingNotify;

class CheckOverDueBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'overdue:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if any booking date is over close it.';

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
        Booking::where('end_date',"<",Carbon::now()->format("Y-m-d"))->
                 whereIn("status",[4,5,6,7,8])->chunk(20, function ($bookings) {
            foreach ($bookings as $booking) {

                $notificationData = [
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => 9,
                'old_status' => 4,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Booking ended successfuly.',
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


                $booking->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

                $notificationData['user'] = $booking->user->name;

                if($booking->vehicle)
                $booking->vehicle->owner->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));
                $booking->status = 9;
                $booking->save();

            }
        });

           $this->sendContractEndingNotification();
    }


    public function sendContractEndingNotification(){

                $target = Carbon::now()->addHours(BOOKING_ENDING_REMINDER_INTERVAL)->format("Y-m-d");
                Booking::where('end_date',"<=",$target)
                         ->whereIn("status",[4,5,7,8])
                         ->whereNull("end_reminder")
                         ->chunk(20, function ($bookings) {
                            
            foreach ($bookings as $booking) {

                $notificationData = [
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => BOOKING_ENDING,
                'old_status' => $booking->status,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Contract ending',
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

               

                $booking->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

                $booking->end_reminder = Carbon::now();

                $booking->save();
            }
        });

    }

}
