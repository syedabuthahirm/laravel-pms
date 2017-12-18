@extends('layouts.app')

@section('content')
    <h4 class="title is-5">Task details</h4>
    <div class="box">
        <h1 class="title is-4">
            {{ $task->title }}
        </h1>
        <div class="content">
            {{ $task->description }}
        </div>
    </div>
    <h4 class="title is-5">Comments</h4>    
    @forelse($comments as $comment)
        <div class="box">
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>{{ $comment->creator->name }}</strong>
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                            @if( Auth::id() === $comment->creator->id )
                                @can('comments.update',[$task,$comment])
                                    <a href="{{ route('tasks.comments.edit',['task'=>$task->id,'comment'=>$comment->id]) }}">Edit</a>
                                @endcan
                                @can('comments.delete',[$task,$comment])
                                    <a href="{{ route('tasks.comments.destroy',['task'=>$task->id,'comment'=>$comment->id]) }}">Delete</a>
                                @endcan
                            @endif
                        </p>
                        <p>
                        {{ $comment->body }}
                        </p>
                    </div>
                </div>
            </article>
        </div>
    @empty
        <div class="box has-text-centered">
            No comments.
        </div>
    @endforelse

    @can('comments.create',$task)
        <h4 class="title is-5">New Comment</h4>
        @include('comments.create')
    @endcan

@endsection