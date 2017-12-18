<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Project;
use App\Credential;

class CredentialPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return ($user->hasRole('admin')) ? true : null;
    }
    
    public function index(User $user, Project $project, Credential $credential = null)
    {
        return $this->hasPermission('view_credentials', $user, $project);
    }

    public function create(User $user, Project $project, Credential $credential = null)
    {
        return $this->hasPermission('create_credentials', $user, $project);
    }

    public function update(User $user, Project $project, Credential $credential)
    {
        return (($this->hasPermission('edit_credentials', $user, $project)) && ($credential->project_id === $project->id));
    }

    public function view(User $user, Project $project, Credential $credential)
    {
        return (($this->hasPermission('view_credentials', $user, $project)) && ($credential->project_id === $project->id));
    }

    public function delete(User $user, Project $project, Credential $credential)
    {
        return (($this->hasPermission('delete_credentials', $user, $project)) && ($credential->project_id === $project->id));
    }

    public function hasPermission($permission, User $user, Project $project)
    {
        return ($user->can($permission) && ($project->client_id === $user->id));
    }
}
