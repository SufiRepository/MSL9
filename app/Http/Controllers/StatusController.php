<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr; 
use Illuminate\Support\Str;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Status::orderBy('id','DESC')->get();
        return view('status.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name' => 'required',
        //     'email' => 'required|email|max:255|unique:users',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);
        $uuid = Str::orderedUuid();

        $status = new Status();
        $user_id= Auth::user()->id;

        $status->nama         = $request->input('name');
        $status-> uuid         = $uuid;
        $status-> created_by    =    $user_id;

        $status->save();

        return redirect()->route('status.index')
                        ->with('success','status created successfully');
        //
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
        
        $status = Status::find($id);
        return view('status.show',compact('status'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $status = Status::find($id);

        return view('status.edit',compact('status'));

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
        //
        $status = Status::find($id);
        $status    ->nama          = $request->input('nama');
        $status  ->save();

        return redirect()->route('status.show',   $status->id );
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
        
        Status::find($id)->delete();
        return redirect()->route('status.index')
                        ->with('success','status deleted successfully');
    }
}
