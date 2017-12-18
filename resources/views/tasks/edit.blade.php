@extends('layouts.app')


@section('content')
    <div class="box">
        <form action="{{ route('projects.tasks.update',['project'=>$project->id,'task'=>$task->id]) }}" method="POST">
            {{ method_field('PATCH') }}
            @include('tasks.form',['buttonText'=>'Update Task'])
        </form>
    </div>
@endsection