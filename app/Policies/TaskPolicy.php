<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Project;
use App\Task;

class TaskPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return ($user->hasRole('admin')) ? true : null;
    }
    
    public function index(User $user, Project $project, Task $task = null)
    {
        return $this->hasPermission('view_tasks', $user, $project);
    }
    
    public function updateStatus(User $user, Project $project, Task $task)
    {
        return ($this->hasPermission('edit_tasks_status', $user, $project) && ($task->project_id === $project->id));
    }

    public function create(User $user, Project $project, Task $task = null)
    {
        return $this->hasPermission('create_tasks', $user, $project);
    }

    public function update(User $user, Project $project, Task $task)
    {
        return ($this->hasPermission('edit_tasks', $user, $project) && ($task->project_id === $project->id));
    }

    public function view(User $user, Project $project, Task $task)
    {
        return ($this->hasPermission('view_tasks', $user, $project) && ($task->project_id === $project->id));
    }

    public function delete(User $user, Project $project, Task $task)
    {
        return ($this->hasPermission('delete_tasks', $user, $project) && ($task->project_id === $project->id));
    }

    public function hasPermission($permission, User $user, Project $project)
    {
        return ($user->can($permission) && ($project->client_id === $user->id));
    }
}
