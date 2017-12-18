@extends('layouts.app')

@section('content')
    <div class="box">
        <h1 class="title is-4">
            {{ $project->title }}
        </h1>
        <div class="body">
            {{ $project->description }}
        </div>
    </div>
    <h2 class="title is-5">Tasks Overview</h2>
    @foreach ($taskGroupCounts->chunk(5) as $chunk)
    <div class="columns">
        @foreach($chunk as $taskGroup)
        <div class="column is-one-fifth">
            <a href="{{ route('projects.tasks.index',['project'=>$project->id,'status'=>$taskGroup->status->slug]) }}">
                <div class="box has-text-centered">
                    <div class="title is-5">
                        {{ $taskGroup->status->title }}
                    </div>
                    <div class="subtitle is-2">
                        {{ $taskGroup->count }}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endforeach
@endsection