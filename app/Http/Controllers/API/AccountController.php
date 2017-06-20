<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Account;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner');
    }

    /**
     * Display a listing of the account.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return api_response($request->user()->account);
    }

    /**
     * Store a newly created account information for Owner
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'number' => 'required|string',
            'sortcode' => 'required|string',
            'default' => 'numeric',
        ]);

        $account = Account::firstOrNew(['title' => $request->title, 'number' => $request->number, 'sortcode' => $request->sortcode]);

        if (!$account->exists)
            $request->user()->account()->save($account);

        return api_response(trans('account.created', ['name' => $request->user()->last_name]));
    }

    /**
     * Display the specified account.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $account = $request->user()->account->where('id', $id)->first();

        if (!$account) abort(404);

        return api_response($account);
    }

    /**
     * Update the specified account in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'string',
            'number' => 'string',
            'sortcode' => 'string',
            'default' => 'numeric',
        ]);

        $account = $request->user()->account->where('id', $id)->first();

        if (!$account) abort(404);

        $account->fill($request->all());

        $account->save();

        return api_response($account);
    }

    /**
     * Remove the specified account from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $account = $request->user()->account->where('id', $id)->first();

        if (!$account) abort(404);

        $account->delete();

        return api_response(trans('account.deleted', ['name' => $request->user()->last_name]));
    }
}
