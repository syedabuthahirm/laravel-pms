@extends('layouts.app')

@section('content')
    <div class="box">
        <form action="{{ route('statuses.store') }}" method="POST">
            @include('statuses.form',['buttonText'=>'Create Status'])
        </form>
    </div>
@endsection