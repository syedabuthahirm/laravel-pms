@extends('layouts.app')

@section('content')
    <div class="level">
        <div class="level-left">
            <a href="{{ route('projects.tasks.index',['project'=>$project->id]) }}" class="level-item">All</a>   
            <span class="level-item">|</span>                     
            @foreach($statuses as $status)
                <a href="{{ route('projects.tasks.index',['project'=>$project->id,'status'=>$status->slug]) }}" class="level-item">{{ $status->title }}</a>
                @if (!$loop->last)
                    <span class="level-item">|</span>
                @endif
            @endforeach
        </div>
        <div class="level-right">
            @can('credentials.index',$project)
                <a href="{{ route('projects.credentials.index',['project'=>$project->id]) }}" class="level-item link">Credentials</a>
            @endcan
            @can('tasks.create',$project)
                <a href="{{ route('projects.tasks.create',['project'=>$project->id]) }}" class="level-item button is-success">New Task</a>
            @endcan
        </div>
    </div>
   {{ $table->display() }}
@endsection