@extends('layouts.app')

@section('content')
<div class="box">
    <form action="{{ route('tasks.comments.update',['task'=>$task->id,'comment'=>$comment->id]) }}" method="POST">
        {{ method_field('PATCH') }}
        @include('comments.form',['buttonText'=>'Update comment','newComment'=>$comment])
    </form>
</div>
@endsection