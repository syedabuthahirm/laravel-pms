<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\Table\TaskTable;
use Illuminate\Http\Request;
use App\Filters\TaskFilters;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, TaskFilters $filters)
    {
        $tasks = Task::getTasksByProject($project, $filters)->latest()->paginate(20);
        $table = new TaskTable($tasks, $project);
        return view('tasks.index', compact('project', 'tasks', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $task = new Task();
        return view('tasks.create', compact('project', 'task'));
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
        $data = $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'status_id' => 'required|exists:statuses,id'
                ]);

        $project->addTask($data);

        flash('Task created Successfully.');

        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        return view('tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $data = $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'status_id' => 'required|exists:statuses,id'
                ]);

        $task->update($data);

        flash('Task updated Successfully.');

        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        flash('Task deleted Successfully.', 'info');
        return redirect()->route('projects.tasks.index', $project->id);
    }

    public function updateStatus(Request $request, Project $project, Task $task)
    {
        $data = $request->validate([
            'status_id' => 'required|exists:statuses,id'
        ]);
        $task->update($data);
        return response('Task status updated successfully');
    }
}
