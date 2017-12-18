<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Project;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return ($user->hasRole('admin')) ? true : null;
    }

    public function index(User $user)
    {
        return $user->can('view_projects');
    }

    public function create(User $user)
    {
        return $user->can('create_projects');
    }

    public function updateStatus(User $user, Project $project)
    {
        return $this->hasPermission('edit_projects_status', $user, $project);
    }

    public function update(User $user, Project $project)
    {
        return $this->hasPermission('edit_projects', $user, $project);
    }

    public function view(User $user, Project $project)
    {
        return $this->hasPermission('view_projects', $user, $project);
    }

    public function delete(User $user, Project $project)
    {
        return $this->hasPermission('delete_projects', $user, $project);
    }

    public function hasPermission($permission, User $user, Project $project)
    {
        return ($user->can($permission) && ($project->client_id === $user->id));
    }
}
