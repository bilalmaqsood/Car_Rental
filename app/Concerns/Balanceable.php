<?php
/**
 * Created by PhpStorm.
 * User: oknasir
 * Date: 6/20/2017
 * Time: 3:50 PM
 */

namespace Qwikkar\Concerns;


use Qwikkar\Models\BalanceLog;

trait Balanceable
{
    /**
     * Add balance in user's account
     *
     * @param $amount
     */
    public function addBalance($amount)
    {
        // TODO: add payment method GoCardLess|Paypal|Stripe

        $balanceLog = new BalanceLog([
            'amount' => $amount,
            'comment' => 'add payment from card',
        ]);

        $balanceLog->balance()->associate($this->balance);

        $this->balanceLogs()->save($balanceLog);

        $this->balance->current += $amount;

        $this->balance->save();
    }
}