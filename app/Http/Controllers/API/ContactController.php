<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Mail\ContactUs;

class ContactController extends Controller
{
    /**
     * Invoke email to support of application for query
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'phone:GB',
            'subject' => 'string',
            'message' => 'required|string',
        ]);

        \Mail::send(new ContactUs($request->all()));

        return api_response(trans('contact.success'));
    }
}
