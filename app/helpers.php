<?php

function flash( $message, $type = 'success' )
{
    request()->session()->flash('info',compact(array('message','type')));
}

function hasFlash()
{
    return ( session()->has('info') ) ? session('info') : false;
}

function isActive($routeName)
{
    return ( Route::currentRouteName() === $routeName ) ? 'is-active' : '';
}

function getPageTitle() {
    $currentRouteName = Route::currentRouteName();
    $titles = config('pms.pagetitles');
    return ( isset( $titles[$currentRouteName] ) ) ? $titles[$currentRouteName] : '';
}