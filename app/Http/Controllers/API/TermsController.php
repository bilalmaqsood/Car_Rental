<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;

class TermsController extends Controller
{
    /**
     * All terms and condition types which are allowed
     */
    protected $types = [
        'app',
    ];

    /**
     * TermsController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if (!in_array($request->type, $this->types)) abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Generate Terms and condition for API
     *
     * @param Request $request
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request, $type)
    {
        return api_response(view("terms.{$type}")->render());
    }
}
