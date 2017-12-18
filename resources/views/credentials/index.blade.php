@extends('layouts.app')

@section('content')
    <div class="level">
        <div class="level-left">
        </div>
        <div class="level-right">
            @can('tasks.create',$project)
                <a href="{{ route('projects.tasks.index',['project'=>$project->id]) }}" class="level-item link">Tasks</a>
            @endcan
            @can('credentials.index',$project)
                <a href="{{ route('projects.credentials.create',['project'=>$project->id]) }}" class="level-item button is-success">New Credential</a>
            @endcan
        </div>
    </div>
    {{ $table->display() }}
@endsection