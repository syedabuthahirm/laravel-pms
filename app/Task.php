<?php

namespace App;

use App\Status;
use App\Project;
use App\Traits\Userstamps;
use App\Filters\TaskFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, Userstamps;
    
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ['status'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, TaskFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * A task belongs to status
     *
     * @return void
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * A taks belongs to project.
     *
     * @return void
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * A task may have many comments.
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Add a comment to task.
     *
     * @param array $attributes
     * @return void
     */
    public function addComment($attributes)
    {
        return $this->comments()->create($attributes);
    }

    /**
     * Get a project by taks
     *
     * @param Project $project
     * @param TaskFilters $filters
     * @return void
     */
    public static function getTasksByProject(Project $project, TaskFilters $filters)
    {
        return static::where('project_id', $project->id)->filter($filters);
    }
}
