<?php

namespace App\Table;

class StatusTable extends Table
{
    protected $primaryKey = 'title';

    protected $columns = [
        'title' => 'Title',
        'slug' => 'Slug',
    ];

    public function generateQuickActionLinks($item)
    {
        return [
            'edit' => [
                'title' => 'Edit',
                'link' => route('statuses.edit',$item->id)
            ]
        ];
    }
}
