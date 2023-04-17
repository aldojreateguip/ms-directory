@extends('layout.load_table')

@section('title', 'Roles')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('forms')



<div id="add_record_box" class="collapse">
    <form id="aform" action="{{url ('create-role')}}" class="needs-validation" novalidate method="POST">
        @csrf
        <div class="role_form">
            <div class="row__center">
                <div class="role-box smooth">
                    <div class="role-item span">
                        <h1 for="arole">{{__('Agregar Rol')}}</h1>
                    </div>
                    <div class="role-item smooth">
                        <input type="text" name="arole" id="arole" class="form-control" autocomplete="off" placeholder="Nombre del rol" required>
                        <div class="invalid-feedback">
                            Porfavor completa este campo
                        </div>
                    </div>
                    <div class="role-item smooth">
                        <button id="createRole" name="createRole" type="submit" data-toggle="tooltip" data-bs-placement="bottom" title="Verificar rol" class="btn btn-success createRole" disabled>
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </button>
                    </div>
                    <div id="role_list" name="role_list" class="role-item span smooth">

                    </div>
                </div>
            </div>
            <div class="row__center">
                <!-- <button id="createRole" type="submit" class="btn btn-primary create_role_btn">{{__('save')}}</button> -->
            </div>
        </div>
    </form>
</div>


@endsection

@section('table_title')
<h1>Lista Roles</h1>
@endsection

@section('head_data')
<tr>
    <th>{{__('Action')}}</th>
    <th>{{__('Descripción')}}</th>
    <th>{{__('Estado')}}</th>
</tr>
@endsection

@section('row_data')
@foreach($roles as $role)
<tr>
    <td>
        <button title="Actualizar" data-toggle="tooltip" data-bs-placement="bottom" data-record-id="{{$role->role_id}}" class="action-btn btn-success editbtn" data-bs-toggle="collapse" data-bs-target="#update_record_box" aria-controls="update_record_box" aria-expanded="false">
            <i class="bi bi-pencil-square"></i>
        </button>
        <button title="Eliminar" data-toggle="tooltip" data-bs-placement="bottom" data-record-id="{{$role->role_id}}" class="action-btn btn-danger deletebtn">
            <i class="bi bi-x-square"></i>
        </button>
        <button type="button" data-toggle="tooltip" data-bs-placement="bottom" title="Ver Permisos" data-record-id="{{$role->role_id}}" class="action-btn btn-info permission" data-bs-toggle="modal" data-bs-target="#role_permissions" aria-controls="role_permissions" aria-expanded="false">
            <i class="fa-solid fa-list"></i>
        </button>
    </td>
    <td>{{ $role->role_description}}</td>
    <td>
        @if( $role->role_state == 1)
        <button title="Habilitado" type="button" data-toggle="tooltip" data-bs-placement="bottom" class="btn role_button_state ena" data-id="{{$role->role_id}}" data-user="{{$role->role_id}}" data-state="0">
            <i class="bi bi-toggle-on"></i>
        </button>
        @else
        <button title="Deshabilitado" type="button" data-toggle="tooltip" data-bs-placement="bottom" class="btn role_button_state disa" data-id="{{$role->role_id}}" data-user="{{$role->role_id}}" data-state="1">
            <i class="bi bi-toggle-on"></i>
        </button>
        @endif
    </td>
</tr>
@endforeach
@endsection

@section('js')

@if (session('status') == 'registered')
<script>
    Swal.fire(
        'Éxito',
        'El registro se realizó correctamente.',
        'success'
    )
</script>
@endif

@vite(['resources/js/role.js'])

@endsection