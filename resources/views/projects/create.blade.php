@extends('layouts.app')


@section('content')
    <div class="box">
        <form action="{{ route('projects.store') }}" method="POST">
            @include('projects.form',['buttonText'=>'Create Project'])
        </form>
    </div>
@endsection