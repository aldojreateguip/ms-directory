@extends('layout.layout')
@section('title', 'Home')

@section('content')
<!-- <div class="home-container">
    <div class="ms-title">
        <p>MS-DIRECTORY</p>
    </div>


    <div class="ms-main">
        <div class="left-main-content">
            <div class="logo">
                <img src="./assets/logo-iiap.png" alt="iiap">
            </div>
        </div>
        <div class="right-main-content">
            <p>INSTITUTO NACIONAL <br> DE LA AMAZONÍA PERUANA</p>
        </div>
    </div>
</div> -->

<div class="home-container text-center">
  <div class="row">
    <div class="col-2">
        <div class="left-main-content">
            <div class="logo"></div>
        </div>
    </div>
    <div class="col-10" style="background: black;">
        <div class="ms-title">
            <p>MS-DIRECTORY</p>
        </div>
        <div class="right-main-content">
            <p>INSTITUTO NACIONAL <br> DE LA AMAZONÍA PERUANA</p>
        </div>
    </div>
</div>

@endsection