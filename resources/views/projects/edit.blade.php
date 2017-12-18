@extends('layouts.app')


@section('content')
    <div class="box">
        <form action="{{ route('projects.update',$project->id) }}" method="POST">
            {{ method_field('PATCH') }}
            @include('projects.form',['buttonText'=>'Upate dProject'])
        </form>
    </div>
@endsection