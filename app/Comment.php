<?php

namespace App;

use App\Task;
use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, Userstamps;
    
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ['creator'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * A Comment belongs to Task
     *
     * @return void
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
