@extends('layouts.app')

@section('content')
    <div class="level">
        <div class="level-left">
            <a href="{{ route('projects.index') }}" class="level-item">All</a>
            <span class="level-item">|</span>                     
            @foreach($statuses as $status)
                <a href="{{ route('projects.index',['status'=>$status->slug]) }}" class="level-item">{{ $status->title }}</a>
                @if (!$loop->last)
                    <span class="level-item">|</span>
                @endif
            @endforeach
        </div>
        <div class="level-right">
            @can('projects.create')
                <a href="{{ route('projects.create') }}" class="level-item button is-success">New Project</a>
            @endcan
        </div>
    </div>
    {{ $table->display() }}
@endsection