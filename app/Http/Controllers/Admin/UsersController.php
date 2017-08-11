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
        $user_type = null;
        $user_types = UserType::all()->pluck("name","id");

        return view("admin.users.create",compact("user","user_types","user_type"));
    }

    public function store(UserModel $request)
    {
        $user = User::create($request->all());
        $user->addType($request->user_type);
        
        return redirect()->route('users.index');
    }

 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        $user_type = $user->types()->first()->name;
        if($user_type=='client'){
            $user = $user->load("client");
        }
       
        return view("admin.users.show",compact("user","user_type"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = User::find($id); 
        $user_types = UserType::all()->pluck("name","id");
        $user_type = $user->types()->first()->id;
        return view("admin.users.edit",compact("user","user_types","user_type"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserModel $request, $id)
    {
        $user = User::find($id); 
        $user->fill($request->all());
        if($request->new_password)
            $user->password = $request->new_password;
        $user->save();
        $user->types()->sync($request->user_type);


        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $status = User::destroy($id);

        if(request()->ajax())
        {

            return response()->json([
                'success' => $status == 1 ? 'true' : 'false'
            ]);
        }

    }


    public function verifyDriver($id)
    {
        $user = User::whereId($id)->first();
        $user->client()->update(['dlc' => true]);
        return api_response('Driver verified successfully');
    }
}
