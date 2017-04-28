<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\CreditCard;

class CreditCardController extends Controller
{
    /**
     * CreditCardController constructor.
     */
    public function __construct()
    {
        $this->middleware('client');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return api_response($request->user()->creditCard);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'number' => 'required|ccn',
            'expiry' => 'required|ccd',
            'address' => 'required|string'
        ]);

        $creditCard = CreditCard::firstOrNew(['number' => $request->number, 'expiry' => $request->expiry]);

        if (!$creditCard->exists) {
            $creditCard->fill($request->all());
            $request->user()->creditCard()->save($creditCard);
        }

        return api_response(trans('credit_card.created', ['name' => $request->user()->last_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $creditCard = $request->user()->creditCard->where('id', $id)->first();

        if (!$creditCard) abort(404);

        return api_response($creditCard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'number' => 'required|ccn',
            'expiry' => 'required|ccd',
            'address' => 'required|string'
        ]);

        $creditCard = $request->user()->creditCard->where('id', $id)->first();

        if (!$creditCard) abort(404);

        $creditCard->fill($request->all());

        $creditCard->save();

        return api_response($creditCard);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $creditCard = $request->user()->creditCard->where('id', $id)->first();

        if (!$creditCard) abort(404);

        $creditCard->delete();

        return api_response(trans('credit_card.deleted', ['name' => $request->user()->last_name]));
    }
}
