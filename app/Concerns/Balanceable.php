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

        $pay_rsp = $this->processPayment($creditCard,$amount);

        $this->notify(new CreditCardNotify([
            'id' => $creditCard->id,
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

    public function processPayment($creditCard,$amount){

        $key = env('STRIPE_KEY');
        $secret = env('STRIPE_SECRET');

        \Stripe\Stripe::setApiKey($key);

        $month = explode("/",$creditCard->expiry)[0];
        $year = explode("/",$creditCard->expiry)[1];

        $token = \Stripe\Token::create(array(
            "card" => array(
                "number"    => $creditCard->number,
                "exp_month" => $month,
                "exp_year"  => $year,
                "cvc"       => 123, //TODO: make it dynamic
                "name"      => $creditCard->name
            )));

        $options = array(
            'source' => $token,
            'description' => "Charge ".$amount." against rent a car on Qwikkar"
        );
        return $this->charge($amount, $options );

    }
}