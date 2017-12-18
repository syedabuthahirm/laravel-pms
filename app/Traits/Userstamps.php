<?php

namespace App\Traits;

use App\User;

trait Userstamps
{

    public static function bootUserstamps()
    {
        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');        
    }

    public function editor()
    {
        return $this->belongsTo(User::class,'updated_by');        
    }

}
