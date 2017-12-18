@extends('layouts.master')

@section('app')
<section class="hero is-danger is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
        <h1 class="title">
            Page not found.
        </h1>
        <a class="button is-primary" href="{{ route('dashboard') }}">Go Home</a>
        </div>
    </div>
</section>
@endsection