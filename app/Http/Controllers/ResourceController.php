<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Auth;

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
        $data = Resource::all();
        //dd($projects);
        return view('tasks.index',compact('data'));
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

        return view('tasks.create',compact('tasks','projects'));
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
            'taskname' => ['required', 'string', 'max:191'],
            'taskdescription' => ['required', 'string', 'max:255'],
            'taskstatus' => ['required', 'string', 'max:255'],
            // 'client_company' => ['required', 'string', 'max:255'],
            // 'project_leader' => ['required', 'string', 'max:255'],
            // 'estimated_budget' => ['required', 'string', 'max:255'],
            // 'spent_budget' => ['required', 'string', 'max:255'],
            // 'project_duration' => ['required', 'string', 'max:255'],
        ]);
        $newResource = new Resource();
        $newResource -> name                  = $request->input('taskname');
        $newResource -> description           = $request->input('taskdescription');
        $newResource -> status                = $request->input('taskstatus');
        $newResource -> project_id            = $request->input('project_id');
     
        $newResource->save();
        //add
        $newResource->users()->attach(Auth::user());

        return redirect()->route('tasks.index')
                        ->with('success','Task created successfully');
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

        dd($resource);
        return view('tasks.show',compact('task'));
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
        // dd($project);
        return view('tasks.edit',compact('task'));
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
        $updateresource -> name                  = $request->input('projectname');
        $updateresource -> description           = $request->input('projectdescription');
        $updateresource -> status                = $request->input('projectstatus');
        $updateresource -> client_company              = $request->input('clientcompany');
        $updateresource -> project_leader              = $request->input('projectleader');
        $updateresource -> estimated_budget    = $request->input('estimatedbudget');
        $updateresource -> spent_budget        = $request->input('spentbudget');
        $updateresource -> project_duration      = $request->input('projectduration');
        $updateresource->update();
        //dd($request);
        return redirect()->route('tasks.index')->with('success','Project updated successfully');
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
