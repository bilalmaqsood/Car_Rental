<?php

namespace Qwikkar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Qwikkar\Models\PromoCode;
use Qwikkar\Http\Controllers\Controller;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {

           $promo_code = new PromoCode();

            return $promo_code->getDataTableData();
        }
        return view("admin.promocode.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promo_code = new PromoCode();

        return view("admin.promocode.create",compact("promo_code"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       PromoCode::create($request->all()); 
       return redirect()->route("promocodes.index");  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $promo_code  = PromoCode::find($id); 
        return view("admin.promocode.show",compact("promo_code"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $promo_code  = PromoCode::find($id); 
        return view("admin.promocode.edit",compact("promo_code"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promo_code  = PromoCode::find($id);
        $promo_code->fill($request->all());
        $promo_code->save();
        return redirect()->route("promocodes.index");   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = PromoCode::destroy($id);

        if(request()->ajax())
        {

            return response()->json([
                'success' => $status == 1 ? 'true' : 'false'
            ]);
        }
        
    }
}
