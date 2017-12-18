<?php

namespace App;

use App\Project;
use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credential extends Model
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

    /**
     * Credential belongs to project
     *
     * @return void
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
