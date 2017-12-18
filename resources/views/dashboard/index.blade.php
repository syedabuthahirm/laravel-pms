@extends('layouts.app')

@section('content')
    <h2 class="title is-5">
        Projects overview
    </h2>
    @forelse($projectGroupCounts->chunk(5) as $chunk)
        <div class="columns">
            @foreach($chunk as $projectGroup)
            <div class="column is-one-fifth">
                <a href="{{ route('projects.index',['status'=>$projectGroup->slug]) }}">
                    <div class="box has-text-centered">
                        <div class="title is-5">
                            {{ $projectGroup->title }}
                        </div>
                        <div class="subtitle is-2">
                            {{ $projectGroup->count }}
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    @empty
        <p class="has-text-centered">
            No projects yet.
        </p>
    @endforelse
@endsection