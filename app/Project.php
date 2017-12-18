<?php

namespace App;

use App\User;
use App\Task;
use App\Status;
use App\Credential;
use App\Traits\Userstamps;
use App\Filters\ProjectFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use SoftDeletes, Userstamps;
    
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $with = ['client','status'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        $user = Auth::user();
        if ($user->hasRole('client')) {
            static::addGlobalScope('clientProjects', function (Builder $builder) use ($user) {
                $builder->where('client_id', '=', $user->id);
            });
        }
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ProjectFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ProjectFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * A project belongs to status
     *
     * @return void
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * A project belongs to client(User)
     *
     * @return void
     */
    public function client()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A project may have many tasks.
     *
     * @return void
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Tasks counts based on their status.
     *
     * @return void
     */
    public function tasksGroupbyCount()
    {
        return $this->hasMany(Task::class)->select(\DB::raw('count(*) as count, status_id'))->groupBy('status_id')->get();
    }

    /**
     * Add a task to project.
     *
     * @param array $attribures
     * @return void
     */
    public function addTask($attribures)
    {
        return $this->tasks()->create($attribures);
    }

    /**
     * A project may have many credentials.
     *
     * @return void
     */
    public function credentials()
    {
        return $this->hasMany(Credential::class);
    }

    /**
     * Add a credential to project
     *
     * @param array $attribures
     * @return void
     */
    public function addCredential($attribures)
    {
        return $this->credentials()->create($attribures);
    }
}
