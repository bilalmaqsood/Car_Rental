<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\PromoCode;

class PromoCodeController extends Controller
{
    /**
     * Verify promo code
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $this->validate($request, [
            'promo_code' => 'exists:promo_codes,code'
        ]);

        return api_response(true);
    }

    /**
     * Get promo code information
     *
     * @param $code
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function info($code)
    {
        $promoCode = PromoCode::whereCode($code)->first();

        if (!$promoCode)
            throw new ModelNotFoundException();

        return api_response($promoCode);
    }
}
