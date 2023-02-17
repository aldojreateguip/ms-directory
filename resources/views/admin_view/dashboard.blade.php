@guest
<div style="background: red; width: 100%; height: 100%;"></div>
@endguest
@auth
@extends('layout.layout')

@section('title', 'Admin Dashboard')
@section('content')
<!-- <div class="menu__side">
    <div class="icon__menu-box">
        <div class="icon__menu">
            <i class="bi bi-list" title="Menú"></i>
        </div>
    </div>
    <div class="options__menu">
        <a href="#" class="selected">
            <div class="option">
                <i class="bi bi-globe-americas" title="Ubigeo"></i>
                <h4>UBIGEO</h4>
            </div>
        </a>
        <a href="#">
            <div class="option">
                <i class="bi bi-person-vcard" title="Persona"></i>
                <h4>PERSONA</h4>
            </div>
        </a>
        <a href="#">
            <div class="option sub" style="background: red;" title="Instituto - Persona">
                <i class="bi bi-circle-fill"></i>
                <h4>INSTITUTO - PERSONA</h4>
            </div>
        </a>
        <a href="#">
            <div class="option sub">
                <i class="bi bi-people-fill" title="Usuario"></i>
                <h4>USUARIO</h4>
            </div>
        </a>
        <a href="#">
            <div class="option">
                <i class="bi bi-buildings" title="Instituto"></i>
                <h4>INSTITUTO</h4>
            </div>
        </a>
    </div>
</div> -->


<!-- <div class="dashboard-box">
    <div class="sidebar-border-box">
        <div class="sidebar">
            <div class="menu-box">
                <div class="menu-tag">
                    <p>Menu</p>
                </div>
            </div>
            <a class="sidebar-item-group" href="ubigeo"><i class="bi bi-globe-americas"></i>
                <p>UBIGEO</p>
            </a>
            <a class="sidebar-item-group" href="person"><i class="bi bi-person-vcard"></i>
                <p>PERSONAS</p>
            </a>
            <a class="sidebar-item-group inconless" href="institution_person">INSTITUTO - PERSONA</a>
            <a class="sidebar-item-group" href="user"><i class="bi bi-people-fill"></i> USUARIOS</a>
            <a class="sidebar-item-group" href="institution"><i class="bi bi-buildings"></i> INSTITUCIÓN</></a>
        </div>
    </div>
    <div class="content-area">
        @yield('content-area')
    </div>
</div> -->
@endsection
@endauth