<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $this->middleware('not-admin');
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
            'address' => 'string',
            'default' => 'numeric',
        ]);

        if ($request->has('default') && $request->default == 1)
            $request->user()->account->each(function ($account) {
                $account->default = 0;
                $account->save();
            });

        $account = Account::firstOrNew(['title' => $request->title, 'number' => $request->number, 'sortcode' => $request->sortcode]);

        if (!$account->exists) {
            $account->fill($request->all());
            $request->user()->account()->save($account);
        }

        return api_response($account);
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

        if (!$account) throw new ModelNotFoundException();

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
            'address' => 'string',
            'default' => 'numeric',
        ]);

        if ($request->has('default') && $request->default == 1)
            $request->user()->account->each(function ($account) {
                $account->default = 0;
                $account->save();
            });

        $account = $request->user()->account()->where('id', $id)->first();

        if (!$account) throw new ModelNotFoundException();

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

        if (!$account) throw new ModelNotFoundException();

        $account->delete();

        return api_response(trans('account.deleted', ['name' => $request->user()->name]));
    }
}
