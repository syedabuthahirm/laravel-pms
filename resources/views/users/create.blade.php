@extends('layouts.app')

@section('content')
<div class="box">
    <form action="{{ route('users.store') }}" method="POST">
        @include('users.form',['buttonText'=>'Create client'])
    </form>
</div>
@endsection