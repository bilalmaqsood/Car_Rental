<?php

namespace Qwikkar\Concerns;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Qwikkar\Models\Booking;
use Qwikkar\Models\PromoCode;
use Qwikkar\Models\User;

trait Couponize
{
    /**
     * Generate coupon code for offers
     *
     * @param integer $length
     * @param float $reward
     * @param Carbon $expiry
     * @return PromoCode|\Illuminate\Database\Eloquent\Model
     */
    public static function generate($length, $reward, Carbon $expiry)
    {
        $couponCode = Coupon::generate(['length' => $length]);

        if (self::verify($couponCode))
            self::generate($length, $reward, $expiry);

        return PromoCode::create([
            'code' => $couponCode,
            'reward' => $reward,
            'expire_at' => $expiry,
        ]);
    }

    /**
     * Verify coupon code
     *
     * @param $code
     * @return PromoCode|\Illuminate\Database\Eloquent\Model|bool
     */
    public static function verify($code)
    {
        $promoCode = PromoCode::firstOrNew(['code' => $code, 'is_active' => 1]);

        return $promoCode->exists ? $promoCode : false;
    }

    /**
     * Proceed to add coupon on registration
     *
     * @param Booking|User $model
     * @param Request $request
     * @return bool|\Illuminate\Database\Eloquent\Model|PromoCode
     */
    public static function processPromoCode($model, Request $request)
    {
        $promoCode = self::verify($request->promo_code);

        $model->promoCodes()->save($promoCode);

        return $promoCode;
    }
}
