<?php

namespace App\Filters;

use App\User;
use App\Status;
use App\Filters\Filters;

class ProjectFilters extends Filters 
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['for','status'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function for($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('client_id', $user->id);
    }

    /**
     * Filter the query by a given status slug.
     *
     * @param  string $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($slug)
    {
        $user = Status::where('slug', $slug)->firstOrFail();
        return $this->builder->where('status_id', $user->id);
    }
}
