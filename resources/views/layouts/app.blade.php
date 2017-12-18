@extends('layouts.master')

@section('app')
<div id="app">
    @include('layouts.nav')
    <div class="page">
        <div class="container is-fluid is-marginless">
            <div class="columns is-marginless">
                @if ( ! Auth::guest())
                    <div class="column is-2 sidebar is-paddingless" v-if="sidebarState">
                        @include('layouts.sidebar')
                    </div>
                @endif
                <div class="column is-paddingless">
                    <div class="page-content">
                        @include('layouts.content-header')
                        <notification :notification="{{ json_encode(hasFlash()) }}"></notification>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection