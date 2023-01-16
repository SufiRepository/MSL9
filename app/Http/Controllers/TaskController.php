<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Auth;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            $tasks = Task::all();
        } else {
            $tasks = $user->tasks()->get();
        }
        return view('tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tasks = Task::all();
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
        $newTask = new Task();
        $newTask -> name                  = $request->input('taskname');
        $newTask -> description           = $request->input('taskdescription');
        $newTask -> status                = $request->input('taskstatus');
        $newTask -> project_id            = $request->input('project_id');
     
        $newTask->save();
        //add
        $newTask->users()->attach(Auth::user());

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
        $task = Task::find($id);

        //dd($task);
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
        $task = Task::find($id);
        //dd($project);
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
        $updateproject = Task::find($id);
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
