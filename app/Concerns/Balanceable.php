<?php

namespace Qwikkar\Concerns;

use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\CreditCard;
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

        $pay_rsp = $this->processPayment($creditCard, $amount);

        $this->notify(new CreditCardNotify([
            'id' => $creditCard->id,
            'type' => 'Payment',
            'title' => 'Payment made',
            'card_ending' => $creditCard->last_numbers,
            'amount' => $amount,
        ]));

        $balanceLog = new BalanceLog([
            'amount' => $amount,
            'payment_response' => \GuzzleHttp\json_encode($pay_rsp),
            'comment' => 'add payment from card',
        ]);

        $balanceLog->balance()->associate($this->balance);

        $this->balanceLogs()->save($balanceLog);

        $this->balance->current += $amount;

        $this->balance->save();
    }

    /**
     * Charge user with strip
     *
     * @param $creditCard
     * @param $amount
     * @return mixed
     */
    public function processPayment(CreditCard $creditCard, $amount)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.key'));

        $listDate = explode("/", $creditCard->expiry);
        $month = $listDate[0];
        $year = $listDate[1];

        $token = \Stripe\Token::create(
            [
                'card' => [
                    'name' => $creditCard->name,
                    'number' => $creditCard->number,
                    'exp_month' => $month,
                    'exp_year' => $year,
                    'cvc' => $creditCard->cvc,
                ]
            ]
        );

        $options = [
            'source' => $token,
            'description' => 'Charge ' . $amount . ' against rent a car on Qwikkar'
        ];

        return $this->charge($amount * 100, $options);
    }
}