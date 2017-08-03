<?php

namespace Qwikkar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Qwikkar\Models\Ticket;
use Qwikkar\Http\Controllers\Controller;

class TicketsController extends Controller
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

           $ticket = new Ticket();

            return $ticket->getDataTableData();
        }
        return view("admin.tickets.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = new Ticket();

        return view("admin.tickets.create",compact("ticket"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(request()->all());
       Ticket::create($request->all()); 
       return redirect()->route("Tickets.index");  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ticket  = Ticket::find($id); 
        return view("admin.tickets.edit",compact("ticket"));
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
        $ticket  = Ticket::find($id);
        $ticket->fill($request->all());
        $ticket->save();
        return redirect()->route("Tickets.index");   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
