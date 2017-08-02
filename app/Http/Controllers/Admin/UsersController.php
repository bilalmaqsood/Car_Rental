<?php

namespace Qwikkar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Http\Requests\UserModel;
use Qwikkar\Models\User;
use Qwikkar\Models\UserType;

class UsersController extends Controller
{
    /**
     * Show the application's admin dashboard.
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if(request()->ajax())
        {

           $user = new User();

            return $user->getDataTableData();
        }
        return view("admin.users.index");
    }

    public function create()
    {
        $user = new User();
        $user_types = UserType::all()->pluck("name","id");

        return view("admin.users.create",compact("user","user_types"));
    }

    public function store(UserModel $request)
    {
        $user = User::create($request->all());
        $user->addType($request->user_type);
        
        return redirect()->route('admin.brand.index');
    }
}
