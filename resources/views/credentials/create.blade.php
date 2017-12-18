@extends('layouts.app')


@section('content')
    <div class="box">
        <form action="{{ route('projects.credentials.store',$project->id) }}" method="POST">
            @include('credentials.form',['buttonText'=>'Create Credential'])
        </form>
    </div>
@endsection