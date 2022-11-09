<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jawatan;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class JawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Jawatan::orderBy('id','DESC')->get();
        return view('jawatan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jawatan.create');
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

        $jawatan = new Jawatan();
        $user_id= Auth::user()->id;

        $jawatan->jawatan         = $request->input('name');
        // $jawatan-> created_by    =    $user_id;

        $jawatan->save();

        return redirect()->route('jawatan.index')
                        ->with('success','Jawatan created successfully');
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

        $jawatan = Jawatan::find($id);
        return view('jawatan.show',compact('jawatan'));

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
        $jawatan = Jawatan::find($id);

        return view('jawatan.edit',compact('jawatan'));

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
        $jawatan = Jawatan::find($id);
        $jawatan    ->jawatan          = $request->input('nama');
        $jawatan  ->save();

        return redirect()->route('jawatan.show',   $jawatan->id );
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

        Jawatan::find($id)->delete();
        return redirect()->route('jawatan.index')
                        ->with('success','jawatan deleted successfully');
    }
}
