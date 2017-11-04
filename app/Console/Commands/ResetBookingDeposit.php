<?php

namespace Qwikkar\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Booking;
use Qwikkar\Notifications\BookingNotify;
use Qwikkar\Notifications\RatingNotify;

class ResetBookingDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Successfully closed bookings\'s deposit revert back.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Booking::whereIn("status",[9,11])->chunk(20, function ($bookings) {
            foreach ($bookings as $booking) {
                $balanceLog = new BalanceLog([
                    'amount' => $booking->deposit,
                    'comment' => 'Deposit returned from booking after completion.',
                ]);

                if($booking->balanceLogs()->first()){

                $sriptResponse = json_decode($booking->balanceLogs()->first()->payment_response);

                $balanceLog->balance()->associate($booking->user->balance);

                $balanceLog->loggable()->associate($booking);

                $booking->user->balanceLogs()->save($balanceLog);

                $response = $booking->user->refund($sriptResponse->id, array('amount' => $booking->deposit*100)); // refund to client

                 $booking->user->balance->current += $booking->deposit;
                }

                $booking->user->balance->save();

                $notificationData = [
                    'id' => $booking->id,
                    'type' => 'Booking',
                    'status' => 12,
                    'old_status' => 9,
                    'vehicle_id' => $booking->vehicle ? $booking->vehicle->id : '',
                    'image' => $booking->vehicle ? $booking->vehicle->images->first() : [],
                    'title' => 'Your deposit has been added in your account.',
                    'user' => 'Qwikkar Cron Application',
                    'credit_card' => $booking->account?$booking->account->last_numbers:"",
                    'vehicle' => $booking->vehicle ? $booking->vehicle->vehicle_name : '',
                    'contract_start' => $booking->start_date,
                    'contract_end' => $booking->end_date,
                    'deposit' => $booking->deposit
                ];


                $booking->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

                $notificationData['title'] = 'Deposit has been returned to ' . $booking->user->name . '\'s account.';

                if($booking->vehicle)
                $booking->vehicle->owner->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

                if($booking->vehicle)
                $this->generateRatingNotification($booking);
                $booking->inspections()->where("status","=",0)->update(["is_return"=>0]);
                $booking->status = 12;
                $booking->save();

            }
        });
    }

    protected function generateRatingNotification($booking){

        $owner = $booking->vehicle->owner->user->name;
        $driver = $booking->user->name;

 
       $booking->vehicle->owner->user->notify((new RatingNotify([
            "title" => "Rate to ".$driver,
            'id' => $booking->id,
            'image' => $booking->vehicle->images->first(),
            "booking_id" => $booking->id,
            "status" => 12,
            "old_status" => 12,
        ]))->delay(Carbon::now()->addMinute()));

       $booking->user->notify((new RatingNotify([
            "title" => "Rate to ".$owner,
            'id' => $booking->id,
            "booking_id" => $booking->id,
            'image' => $booking->vehicle->images->first(),
            "status" => 12,
            "old_status" => 12,
        ]))->delay(Carbon::now()->addMinute()));

    }
}
