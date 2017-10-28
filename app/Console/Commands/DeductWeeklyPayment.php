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
        
        Booking::whereIn("status",[4,5,7,8])
                ->with("account")
                ->whereHas("payments" , function($query){
            $query->DuePayment();
        })->chunk(20, function ($bookings) {
            
            

            foreach ($bookings as $booking) {

                $payment = $booking->payments()->DuePayment()->first();
                
                $account = $booking->user->creditCard()->where('default', 1)->first();
                
                $user = $booking->user;

                $result = $user->addBalance($payment->cost,$booking->id);

                if($result)
                    $this->updateBalancedue($payment,$booking);

            }
        });
    }
}
