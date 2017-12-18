<?php

namespace App\Http\Controllers;

use App\Status;
use App\Table\StatusTable;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        $table = new StatusTable($statuses);
        return view('statuses.index',compact('statuses','table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = new Status();
        return view('statuses.create',compact('status'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Status::create([
            'title' => $request->title,
            'slug' => ( $request->slug ) ? str_slug($request->slug) : str_slug($request->title)
        ]);

        flash('Status created Successfully.');        

        return redirect()->route('statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('statuses.edit',compact('status'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'title' => 'required'            
        ]);

        $status->update([
            'title' => $request->title,
            'slug' => ( $request->slug ) ? str_slug($request->slug) : str_slug($request->title)
        ]);

        flash('Status updated Successfully.');        

        return redirect()->route('statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();
        flash('Status deleted Successfully.','info');        
        return redirect()->route('statuses.index');        
    }
}
