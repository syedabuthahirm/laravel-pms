@extends('layouts.app')


@section('content')
    <div class="box">
        <form action="{{ route('projects.credentials.update',['project'=>$project->id,'credential'=>$credential->id]) }}" method="POST">
            {{ method_field('PATCH') }}
            @include('credentials.form',['buttonText'=>'Update Credential'])
        </form>
    </div>
@endsection