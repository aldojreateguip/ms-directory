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
                    <div class="role-item smooth">
                        <label for="arole">{{__('Descripción del rol')}}</label>
                        <input type="text" name="arole" id="arole" class="form-control" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Porfavor completa este campo
                        </div>
                    </div>
                    <div class="role-item smooth">
                        <label>{{__('Permisos')}}</label>
                        <div class="col">
                            <button type="button" data-toggle="tooltip" data-bs-placement="bottom" data-bs-toggle="collapse" data-bs-target="#role-list" aria-controls="add_record_box" aria-expanded="false" title="Agregar permiso" class="btn btn-success addPermission">
                                <i class="fa-solid fa-file-circle-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="role-list" class="role-item span smooth collapse">
                        <hr>
                        <label><strong>Lista de permisos</strong></label>
                        <div id="permission_list" class="role-item-group smooth" >
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row__center">
                <button id="createRole" type="submit" class="btn btn-primary create_role_btn">{{__('save')}}</button>
            </div>
        </div>
    </form>
</div>

<div id="update_record_box" class="collapse">
    <form id="uform" action="{{url ('update-ubigeo')}}" class="needs-validation" novalidate method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="record_id" id="record_id">
        <div class="crud-content">
            <div class="col">
                <label for="ucountry">{{__('country')}}</label>
                <input type="text" name="ucountry" id="ucountry" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete this field
                </div>
            </div>

            <div class="col">
                <label for="udepartment">{{__('department')}}</label>
                <input type="text" name="udepartment" id="udepartment" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete this field
                </div>
            </div>

            <div class="col">
                <label for="umunicipality">{{__('municipality')}}</label>
                <input type="text" name="umunicipality" id="umunicipality" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete this field
                </div>
            </div>
        </div>
        <div class="row-md" style="display: flex; justify-content: center;">
            <button type="submit" value="submit" class="btn btn-success" style="width: 20rem;">{{__('update')}}</button>
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