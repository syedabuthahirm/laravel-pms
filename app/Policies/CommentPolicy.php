<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Comment;
use App\Task;

class CommentPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return ($user->hasRole('admin')) ? true : null;
    }
    
    public function index(User $user, Task $task, Comment $comment = null)
    {
        return $this->hasPermission('view_comments', $user, $task);
    }

    public function create(User $user, Task $task, Comment $comment = null)
    {
        return $this->hasPermission('create_comments', $user, $task);
    }

    public function update(User $user, Task $task, Comment $comment)
    {
        return (($this->hasPermission('edit_comments', $user, $task)) &&
                ($comment->creator->id === $user->id));
    }

    public function delete(User $user, Task $task, Comment $comment)
    {
        return (($this->hasPermission('delete_comments', $user, $task)) &&
                ($comment->creator->id === $user->id));
    }

    public function hasPermission($permission, User $user, Task $task)
    {
        return ($user->can($permission) && (optional($task->project)->client_id === $user->id));
    }
}
