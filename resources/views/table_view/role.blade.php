@extends('layout.load_table')

@section('title', 'Roles')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('forms')


<div id="add_record_box" class="collapse show">
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
                <form id="aPermission" action="{{url ('asign-permission')}}" class="needs-validation" novalidate method="POST">
                    @csrf
                    <input type="hidden" name="role_id" id="role_id" />
                    <div id="role_list" name="role_list" class="role-item span p smooth">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="update_record_box" class="collapse">
    <form id="uform" action="{{url ('role/update')}}" class="needs-validation" novalidate method="POST">
        @csrf
        @method('PUT')
        <div class="role_form">
            <div class="row__center">
                <div class="role-box smooth">
                    <div class="role-item span">
                        <h1 for="urole">{{__('Editar Rol')}}</h1>
                    </div>
                    <div class="role-item smooth">
                        <input type="text" name="uid" id="uid" required>
                        <input type="text" name="urole" id="urole" class="form-control" autocomplete="off" placeholder="Nombre del rol" required>
                        <div class="invalid-feedback">
                            Porfavor completa este campo
                        </div>
                    </div>
                    <div class="role-item smooth">
                        <button id="updateRole" name="updateRole" type="submit" data-toggle="tooltip" data-bs-placement="bottom" title="Guardar Cambios" class="btn btn-info updateRole">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('table_title')
<!-- <h1>Lista Roles <button>visualizar</button></h1> -->
<div class="table-title">
    <h1>Lista Roles</h1>
    <label for="showDeleted" title="Mostar Eliminados" data-toggle="tooltip" data-bs-placement="bottom" class="switch">
        <input id="showDeleted" type="checkbox" class="check_records ena">
        <span class="slider"></span>
    </label>
</div>
@endsection

@section('modals')
<div class="modal fade" id="show_permissions" tabindex="-1" role="dialog" aria-labelledby="userRolesLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content" id="permission_list">
            <a href="">texto</a>
        </div>
    </div>
</div>
@endsection

@section('js')

@if (session('status') == 'registered')
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "El registro se realizó correctamente.",
        showConfirmButton: false,
        timer: 1500,
    });
</script>
@endif

@if (session('status') == 'permissionRegistered')
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Los permisos se añadieron correctamente.",
        showConfirmButton: false,
        timer: 1500,
    });
</script>
@endif
<script>
    
</script>
@vite(['resources/js/role.js'])

@endsection