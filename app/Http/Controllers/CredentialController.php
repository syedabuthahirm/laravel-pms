<?php

namespace App\Http\Controllers;

use App\Project;
use App\Credential;
use Illuminate\Http\Request;
use App\Table\CredentialTable;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $table = new CredentialTable($project->credentials, $project);
        return view('credentials.index', compact('project', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $credential = new Credential();
        return view('credentials.create', compact('project', 'credential'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'username' => 'required',
            'password' => 'required'
        ]);

        $project->addCredential($request->only(['title','url','username','password','others']));

        flash('Credential created Successfully.');

        return redirect()->route('projects.credentials.index', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Credential  $credential
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Credential $credential)
    {
        return view('credentials.show', compact('project', 'credential'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Credential  $credential
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Credential $credential)
    {
        return view('credentials.edit', compact('project', 'credential'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\Credential  $credential
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Credential $credential)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'username' => 'required',
            'password' => 'required'
        ]);

        $credential->update($request->only(['title','url','username','password','others']));

        flash('Credential updated Successfully.');

        return redirect()->route('projects.credentials.index', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @param  \App\Credential  $credential
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Credential $credential)
    {
        $credential->delete();
        flash('Credential Deleted Successfully.', 'info');
        return redirect()->route('projects.credentials.index', $project->id);
    }
}
