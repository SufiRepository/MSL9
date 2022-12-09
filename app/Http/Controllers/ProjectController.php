<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::all();
        //dd($projects);
        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
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
        // dd($request);
        $newProject = new Project();
        $newProject -> name                  = $request->input('projectname');
        $newProject -> description           = $request->input('projectdescription');
        $newProject -> status                = $request->input('projectstatus');
        $newProject -> client_company              = $request->input('clientcompany');
        $newProject -> project_leader              = $request->input('projectleader');
        $newProject -> estimated_budget    = $request->input('estimatedbudget');
        $newProject -> spent_budget        = $request->input('spentbudget');
        $newProject -> project_duration      = $request->input('projectduration');

        $newProject->save();

        return redirect()->route('projects.index')
                        ->with('success','Project created successfully');
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
        $project = Project::find($id);
        // dd($project);
        return view('projects.show',compact('project'));
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
        $project = Project::find($id);
        // dd($project);
        return view('projects.edit',compact('project'));
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
        $updateproject = Project::find($id);
        $updateproject -> name                  = $request->input('projectname');
        $updateproject -> description           = $request->input('projectdescription');
        $updateproject -> status                = $request->input('projectstatus');
        $updateproject -> client_company              = $request->input('clientcompany');
        $updateproject -> project_leader              = $request->input('projectleader');
        $updateproject -> estimated_budget    = $request->input('estimatedbudget');
        $updateproject -> spent_budget        = $request->input('spentbudget');
        $updateproject -> project_duration      = $request->input('projectduration');
        $updateproject->update();
        //dd($request);
        return redirect()->route('projects.index')->with('success','Project updated successfully');
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
        $projectdata = Project::find($id);

        $projectdata->delete();
        return redirect()->route('projects.index')
                    ->with('success','Project deleted successfully');
    }
}
