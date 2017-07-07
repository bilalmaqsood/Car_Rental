<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            'address' => 'required|string',
            'default' => 'numeric',
        ]);

        if ($request->has('default') && $request->default == 1)
            $request->user()->creditCard->each(function ($card) {
                $card->default = 0;
                $card->save();
            });

        $creditCard = CreditCard::firstOrNew(['number' => $request->number, 'expiry' => $request->expiry]);

        if (!$creditCard->exists) {
            $creditCard->fill($request->all());
            $request->user()->creditCard()->save($creditCard);
        }

        return api_response($creditCard);
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

        if (!$creditCard) throw new ModelNotFoundException();

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
            'name' => 'string',
            'number' => 'ccn',
            'expiry' => 'ccd',
            'address' => 'string',
            'default' => 'numeric',
        ]);

        if ($request->has('default') && $request->default == 1)
            $request->user()->creditCard->each(function ($card) {
                $card->default = 0;
                $card->save();
            });

        $creditCard = $request->user()->creditCard()->where('id', $id)->first();

        if (!$creditCard) throw new ModelNotFoundException();

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

        if (!$creditCard) throw new ModelNotFoundException();

        $creditCard->delete();

        return api_response(trans('credit_card.deleted', ['name' => $request->user()->name]));
    }
}
