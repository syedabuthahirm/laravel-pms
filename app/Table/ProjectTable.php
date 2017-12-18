<?php

namespace App\Table;

use App\Table\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Credential;
use App\Task;
use App\Status;

class ProjectTable extends Table
{
    protected $primaryKey = 'title';
    
    protected $columns = [
        'title' => 'Title',
        'status' => 'Status',
        'client' => 'Client'
    ];

    public function __construct($data)
    {
        parent::__construct($data);
        $this->statuses = Status::all();
    }

    public function getColumns()
    {
        if (Auth::user()->hasRole('client')) {
            unset($this->columns['client']);
        }

        return $this->columns;
    }

    public function getColumnValue($column, $project)
    {
        $data = '';

        switch ($column) {
            case 'title':
                $data =  '<a href="'. route('projects.tasks.index', $project->id) .'">'. $project->title .'</a>';
                break;

            case 'status':
                if (Auth::user()->can('projects.updateStatus', $project)) {
                    $data =  view('statuses.dropdown', [
                        'statuses'=>$this->statuses,
                        'model'=>$project,
                        'endPoint' => route('projectsUpdateStatus', $project->id)
                    ]);
                } else {
                    $data =  $project->status->title;
                }
                break;
            
            case 'client':
                $data =  '<a href="'. route('projects.index', ['for'=>$project->client->name]) .'">'.$project->client->name.'</a>';
                break;
            
            default:
                $data = $this->defaultColumnValue($column, $project);
                break;
        }

        return $data;
    }

    public function generateQuickActionLinks($item)
    {
        $links = [];
        $user = Auth::user();
        if ($user->can('projects.view', $item)) {
            $links['details'] = [
                'title' => 'Details',
                'link' => route('projects.show', $item->id)
            ];
        }
        if ($user->can('projects.update', $item)) {
            $links['edit'] = [
                'title' => 'Edit',
                'link' => route('projects.edit', $item->id)
            ];
        }
        if ($user->can('credentials.index', $item, Credential::class)) {
            $links['credential'] = [
                'title' => 'Credentials',
                'link' => route('projects.credentials.index', $item->id)
            ];
        }
        if ($user->can('credentials.create', $item, Credential::class)) {
            $links['new-credential'] = [
                'title' => 'New Credential',
                'link' => route('projects.credentials.create', $item->id)
            ];
        }
        if ($user->can('tasks.create', $item, Task::class)) {
            $links['new-task'] = [
                'title' => 'New Task',
                'link' => route('projects.tasks.create', $item->id)
            ];
        }
        if ($user->can('projects.delete', $item)) {
            $links['delete'] = [
                'title' => 'Delete',
                'link' => route('projects.destroy', $item->id)
            ];
        }
        return $links;
    }
}
