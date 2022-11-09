<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Markas;
use Illuminate\Support\Str;

class Markascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        dd('masuk index');
        $markas = Markas::orderBy('id','DESC')->paginate(5);

        // dd($pasukan->name);

        return view('markas.index',compact('markas'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $permission = Permission::get();
        $pasukan_id = $id;
        return view('markas.create',compact('permission','pasukan_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $uuid = Str::orderedUuid();
 
    // dd( $uuid);
        // dd( $uuid);
        $role = Markas::create([
            'name' => $request->input('name'),
            'pasukan_id' => $request->input('pasukan_id'),
            'uuid' =>$uuid,
        ]);
    
        return redirect()->route('pasukan.index')
                        ->with('success','Pasukan created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd("controller show");
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
        //
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
