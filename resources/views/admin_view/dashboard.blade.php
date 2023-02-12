@extends('layout.layout')
@guest
@section('title', 'Restricted Zone')
@section('content')
<div class="container" style="background: red; width: 100vw; height: 100vh;">
</div>
@endguest

@auth
@section('title', 'Admin Dashboard')
@section('content')
<div class="container" style="background: green; width: 100vw; height: 100vh;">

</div>
@endauth
