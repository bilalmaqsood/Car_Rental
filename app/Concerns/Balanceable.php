<?php

namespace Qwikkar\Concerns;

use Qwikkar\Models\BalanceLog;
use Qwikkar\Notifications\CreditCardNotify;

trait Balanceable
{
    /**
     * Add balance in user's account
     *
     * @param $amount
     */
    public function addBalance($amount)
    {
        $creditCard = $this->creditCard()->where('default', 1)->first();

        // TODO: add payment method GoCardLess|Paypal|Stripe

        $this->notify(new CreditCardNotify([
            'id' => $creditCard->id,
            'title' => 'Payment made',
            'card_ending' => $creditCard->last_numbers,
            'amount' => $amount,
        ]));

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