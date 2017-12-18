<?php

namespace App\Table;

use Illuminate\Support\Facades\Auth;

class CredentialTable extends Table
{
    protected $primaryKey = 'title';

    protected $project;

    public function __construct($data, $project)
    {
        $this->project = $project;
        parent::__construct($data);
    }

    protected $columns = [
        'title' => 'Domain',
        'username' => 'User Name',
        'password' => 'Password',
    ];

    public function getColumnValue($column, $item)
    {
        $data = '';

        switch ($column) {
            case 'title':
                $data =  '<a target="_blank" href="'. $item->url .'">'.$item->title.'</a>';
                break;
            
            default:
                $data = $this->defaultColumnValue($column, $item);
                break;
        }

        return $data;
    }

    public function generateQuickActionLinks($credential)
    {
        $links = [];
        $user = Auth::user();
        if ($user->can('credentials.view', [$this->project, $credential])) {
            $links['view'] = [
                'title' => 'Details',
                'link' => route('projects.credentials.show', ['project'=>$this->project->id,'credential'=>$credential->id])
            ];
        }
        if ($user->can('credentials.update', [$this->project, $credential])) {
            $links['edit'] = [
                'title' => 'Edit',
                'link' => route('projects.credentials.edit', ['project'=>$this->project->id,'credential'=>$credential->id])
            ];
        }
        if ($user->can('credentials.delete', [$this->project, $credential])) {
            $links['delete'] = [
                'title' => 'Delete',
                'link' => route('projects.credentials.destroy', ['project'=>$this->project->id,'credential'=>$credential->id])
            ];
        }
        return $links;
    }
}
