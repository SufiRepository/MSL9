<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PangkatController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:pangkat-list|pangkat-create|pangkat-edit|pangkat-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pangkat-create', ['only' => ['create','store']]);
         $this->middleware('permission:pangkat-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pangkat-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Pangkat::orderBy('id_pangkat','DESC')->get();
        return view('pangkat.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pangkat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pangkat = new Pangkat();

        $pangkat->pangkat         = $request->input('name');
        $pangkat->save();

        return redirect()->route('pangkat.index')
                        ->with('success','Pangkat created successfully');
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
        $pangkat = DB::table('pangkat')->where("id_pangkat",$id)->first();
        return view('pangkat.show',compact('pangkat'));

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
        $pangkat = DB::table('pangkat')->where("id_pangkat",$id)->first();

        return view('pangkat.edit',compact('pangkat'));

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
        $pangkat = DB::table('pangkat')->where("id_pangkat",$id)->first();
        $pangkat  ->pangkat          = $request->input('nama');
        $pangkat  ->update();

        return redirect()->route('pangkat.show',   $pangkat->id );
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
        DB::table('pangkat')->where('id_pangkat', $id)->delete();

        // Pangkat::find($id)->delete();
        return redirect()->route('pangkat.index')
                        ->with('success','Pangkat deleted successfully');
    }
}
