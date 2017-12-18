@extends('layouts.app')

@section('content')
<div class="box">
    <form action="{{ route('users.update',$user->id) }}" method="POST">
        {{ method_field('PATCH') }}
        @include('users.form',['buttonText'=>'Update client'])
    </form>
</div>
@endsection