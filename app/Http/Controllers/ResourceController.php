<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\Resource;
use Auth;
use DB;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resources = Resource::all();
        //dd($resources);
        return view('resources.index',compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tasks = Resource::all();
        $projects = Project::all();

        return view('resources.create',compact('tasks','projects'));
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
        $request->validate([
            'resourcename' => ['required', 'string', 'max:191'],
            'resourcedescription' => ['required', 'string', 'max:255'],
            'project_id' => ['required'],
            // 'client_company' => ['required', 'string', 'max:255'],
            // 'project_leader' => ['required', 'string', 'max:255'],
            // 'estimated_budget' => ['required', 'string', 'max:255'],
            // 'spent_budget' => ['required', 'string', 'max:255'],
            // 'project_duration' => ['required', 'string', 'max:255'],
        ]);
        $newResource = new Resource();
        $newResource -> name                  = $request->input('resourcename');
        $newResource -> description           = $request->input('resourcedescription');     
        $newResource->save();
        //add
        //$newResource->projects()->attach($request->input('project_id'));
        $newResource->projects()->attach($request->input('project_id'), ['created_at' => now(),'updated_at' => now()]);

        return redirect()->route('resources.index')
                        ->with('success','Resource created successfully');
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
        $resource = Resource::find($id);
        // $latestProject = $resource->projects()->orderBy('created_at', 'desc')->first();
        $latestProject = DB::table('projects')
                        ->join('project_resource', 'projects.id', '=', 'project_resource.project_id')
                        ->select('projects.*')
                        ->where('project_resource.resource_id', $id)
                        ->orderBy('project_resource.created_at', 'desc')
                        ->first();

        $resourceProjects = DB::table('projects')
                        ->join('project_resource', 'projects.id', '=', 'project_resource.project_id')
                        ->where('project_resource.resource_id', $id)
                        ->orderBy('project_resource.created_at', 'desc')
                        ->select('projects.*','project_resource.created_at as pivot_created_at')
                        ->get();

        //dd($resourceProjects);
        return view('resources.show',compact('resource','latestProject','resourceProjects'));
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
        $resource = Resource::find($id);
        $projects = Project::all();

        // dd($project);
        return view('resources.edit',compact('resource','projects'));
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
        $updateresource = Resource::find($id);
        $updateresource -> name                  = $request->input('resourcename');
        $updateresource -> description           = $request->input('resourcedescription');
      
        $updateresource->update();
        $updateresource->projects()->attach($request->input('project_id'), ['created_at' => now(), 'updated_at' => now()]);
        //$updateresource->projects()->sync([$request->input('project_id') => ['created_at' => now(), 'updated_at' => now()]]);
        //dd($request);
        return redirect()->route('resources.index')->with('success','Resource updated successfully');
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
        $taskdata = Task::find($id);

        $taskdata->delete();
        return redirect()->route('tasks.index')
                    ->with('success','Project deleted successfully');
    }
}
