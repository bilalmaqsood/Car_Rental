<?php

namespace Qwikkar\Console\Commands;

use Carbon\Carbon;
use Qwikkar\Concerns\Balanceable;
use Illuminate\Console\Command;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Booking;
use Qwikkar\Notifications\BookingNotify;
use Qwikkar\Notifications\RatingNotify;

class DeductWeeklyPayment extends Command
{
    use Balanceable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:deduction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deduct payment weekly from the credit card base on booking';

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
        
        Booking::where("status","<",9)
                ->with("account")
                ->whereHas("payments" , function($query){
            $query->DuePayment();
        })->chunk(20, function ($bookings) {
            
            

            foreach ($bookings as $booking) {

                $payment = $booking->payments()->DuePayment()->first();
                
                $account = $booking->user->creditCard()->where('default', 1)->first();
                
                $user = $booking->user;

                $result = $user->addBalance($payment->cost,$account);

                if($result)
                    $this->updateBalancedue($payment,$booking);

               
               
                
            //     $balanceLog = new BalanceLog([
            //         'amount' => $booking->deposit,
            //         'comment' => 'Deposit returned from booking after completion.',
            //     ]);

            //     $balanceLog->balance()->associate($booking->user->balance);

            //     $balanceLog->loggable()->associate($booking);

            //     $booking->user->balanceLogs()->save($balanceLog);

            //     $booking->user->balance->current += $booking->deposit;

            //     $booking->user->balance->save();

            //     $notificationData = [
            //         'id' => $booking->id,
            //         'type' => 'Booking',
            //         'status' => $booking->status,
            //         'vehicle_id' => $booking->vehicle->id,
            //         'image' => $booking->vehicle->images->first(),
            //         'title' => 'Your deposit has been added in your account.',
            //         'user' => 'Qwikkar Cron Application',
            //         'credit_card' => $booking->account?$booking->account->last_numbers:"",
            //         'vehicle' => $booking->vehicle->vehicle_name,
            //         'contract_start' => $booking->start_date,
            //         'contract_end' => $booking->end_date,
            //         'deposit' => $booking->deposit
            //     ];


            //     $booking->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

            //     $notificationData['title'] = 'Deposit has been returned to ' . $booking->user->name . '\'s account.';

            //     $booking->vehicle->owner->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));
            //     $this->generateRatingNotification($booking);

            //     $booking->status = 12;
            //     $booking->save();

            }
        });
    }

    protected function updateBalancedue($payment,$booking){


        $payment->paid = 1;
        $payment->save();

        $nextDue = $payment->due_date->addWeek();
        $weekNo = $booking->start_date->diffInWeeks($nextDue);
        $currentWeek = $booking->start_date->diffInWeeks(Carbon::now());
            
         /**
         * Calculate discount of the week
         **/ 
        $rent = $booking->vehicle->rent;
        if (count($booking->vehicle->discounts))
            foreach ($booking->vehicle->discounts as $discount) {
                if ($discount['week'] == $currentWeek)
                    $rent -= (100 + $discount['percent']) / 100;
            }

        if($nextDue <= $booking->end_date)
            $booking->payments()->create([
                "title" => 'Week '. $weekNo,
                "cost"  => $rent,
                "due_date" => $nextDue,
                "paid" => 0,


                ]);


    }

}
