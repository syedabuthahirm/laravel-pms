@extends('layouts.app')


@section('content')
    <div class="box">
        <form action="{{ route('projects.tasks.store',$project->id) }}" method="POST">
            @include('tasks.form',['buttonText'=>'Create Task'])
        </form>
    </div>
@endsection