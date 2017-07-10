<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class PromoCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'promo_code' => 'exists:promo_codes,code'
        ]);

        return api_response(true);
    }
}
