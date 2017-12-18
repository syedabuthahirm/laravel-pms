@extends('layouts.app')

@section('content')
    <div class="box">
        <form action="{{ route('statuses.update',$status->id) }}" method="POST">
            {{ method_field('PATCH') }}
            @include('statuses.form',['buttonText'=>'Update Status'])
        </form>
    </div>
@endsection