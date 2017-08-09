<?php

namespace Qwikkar\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Booking;
use Qwikkar\Notifications\BookingNotify;

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
        Booking::whereStatus(9)->chunk(20, function ($bookings) {
            foreach ($bookings as $booking) {
                $balanceLog = new BalanceLog([
                    'amount' => $booking->deposit,
                    'comment' => 'deposit return from booking',
                ]);

                $balanceLog->balance()->associate($booking->user->balance);

                $balanceLog->loggable()->associate($booking);

                $booking->user->balanceLogs()->save($balanceLog);

                $booking->user->balance->current += $booking->deposit;

                $booking->user->balance->save();

                $notificationData = [
                    'id' => $booking->id,
                    'type' => 'Booking',
                    'status' => $booking->status,
                    'vehicle_id' => $booking->vehicle->id,
                    'image' => $booking->vehicle->images->first(),
                    'title' => 'Your deposit has been added in your account.',
                    'user' => 'Qwikkar Cron Application',
                    'credit_card' => $booking->account->last_numbers,
                    'vehicle' => $booking->vehicle->vehicle_name,
                    'contract_start' => $booking->start_date,
                    'contract_end' => $booking->end_date,
                    'deposit' => $booking->deposit
                ];

                $booking->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

                $notificationData['title'] = 'Deposit has been returned to ' . $booking->user->name . '\'s account.';

                $booking->vehicle->owner->user->notify((new BookingNotify($notificationData))->delay(Carbon::now()->addMinute()));

                $booking->status = 12;
                $booking->save();
            }
        });
    }
}
