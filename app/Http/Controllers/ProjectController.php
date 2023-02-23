<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectUpdatedNotification;
use Auth;
use Illuminate\Support\Facades\Notification;

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
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();
        $unreadCount = Auth::user()->unreadNotifications()->count();
        // $projects = Project::with('users')->get();
        //dd($projects);
        return view('projects.index',compact('projects','notifications','unreadCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();

        return view('projects.create',compact('users'));
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
            'projectname' => ['required', 'string', 'max:255'],
            'projectdescription' => ['required', 'string', 'max:255'],
            'projectstatus' => ['required', 'string', 'max:255'],
            // 'client_company' => ['required', 'string', 'max:255'],
            // 'project_leader' => ['required', 'string', 'max:255'],
            // 'estimated_budget' => ['required', 'string', 'max:255'],
            // 'spent_budget' => ['required', 'string', 'max:255'],
            // 'project_duration' => ['required', 'string', 'max:255'],
        ]);
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
        //add
        $newProject->users()->attach($request->input('users_id'));


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
        $projectusers = $project->users();
        $users = User::all();
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();
        $unreadCount = Auth::user()->unreadNotifications()->count();
        //dd($projectusers);
        return view('projects.edit',compact('project','projectusers','users','notifications','unreadCount'));
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

        $updateproject->users()->detach();
        $updateproject->users()->attach($request->input('users_id'));

        $user = Auth::user();
        $project = $updateproject;
        $updatedFields = ['name', 'description'];
        $updatedAt = now();

        $recipients = $updateproject->users->merge(User::whereIn('id', $request->input('users_id'))->get()); // Retrieve all associated users and newly attached users
        Notification::send($recipients, new ProjectUpdatedNotification($project, $user, $updatedFields, $updatedAt));

        // $user->notify(new ProjectUpdatedNotification($project, $user, $updatedFields, $updatedAt));

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
