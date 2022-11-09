<?php

namespace App\Http\Controllers;

use App\Models\OrgChart;
use Illuminate\Http\Request;
use App\Models\Pasukan;

class OrgChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pasukans = Pasukan::select('id','parentId','nama','nama_kem')->get()->toArray();
        //->toJson();
        //dd($pasukans);
        return view('orgchart.index',compact('pasukans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $x = 12;
        dd($x);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrgChart  $orgChart
     * @return \Illuminate\Http\Response
     */
    public function show(OrgChart $orgChart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrgChart  $orgChart
     * @return \Illuminate\Http\Response
     */
    public function edit(OrgChart $orgChart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrgChart  $orgChart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrgChart $orgChart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrgChart  $orgChart
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrgChart $orgChart)
    {
        //
    }
}
