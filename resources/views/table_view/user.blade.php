@extends('layout.load_table')

@section('title', 'Usuario')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@endsection

@section('forms')
<div id="add_record_box" class="collapse show">
    <div class="role_form">
        <div class="row__center">
            <div class="role-box smooth">
                <div class="role-item span">
                    <h1 for="auser">{{__('Agregar Usuario')}}</h1>
                </div>
                <div class="role-item smooth">
                    <label for="auser">Usuario</label>
                    <input type="text" name="auser" id="auser" class="form-control" autocomplete="off" placeholder="Nombre del rol" required>
                    <div class="invalid-feedback">
                        Porfavor completa este campo
                    </div>
                </div>
                <div class="role-item smooth">
                    <label for="apassword">Contraseña</label>
                    <input type="text" name="apassword" id="apassword" class="form-control" autocomplete="off" placeholder="********">
                    <div class="invalid-feedback">
                        Porfavor completa este campo
                    </div>
                </div>
                <div class="role-item smooth">
                    <label for="apersonname">Persona</label>
                    <select type="text" name="apersonname" id="apersonname" class="form-control" autocomplete="off">
                        @foreach($data as $option)
                        <option value="{{ $option->person_id }}">{{$option->person_surname}}, {{$option->person_name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Porfavor completa este campo
                    </div>
                </div>
                <div class="role-item smooth span">
                    <button id="saveUser" name="saveUser" type="submit" data-toggle="tooltip" data-bs-placement="bottom" title="Verificar rol" class="btn btn-success saveUser" disabled>
                        <i class="fa-solid fa-file-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- <div id="add_record_box" class="collapse show">
    <form id="aform" action="{{url ('user/add')}}" class="needs-validation" novalidate method="POST">
        @csrf
        <div class="crud-content" id="crudCont">
            <div class="col">
                <label for="apassword">{{__('Password')}}</label>
                <input type="text" name="apassword" id="apassword" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete or enter a valid password
                </div>
            </div>

            <div class="col">
                <label for="astate">{{__('state')}}</label>
                <input type="number" name="astate" id="astate" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete this field
                </div>
            </div>

            <div class="col">
                <label for="apersonid">{{__('PersonId')}}</label>
                <input type="number" name="apersonid" id="apersonid" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete this field
                </div>
            </div>
        </div>
        <div class="row-md" style="display: flex; justify-content: center;">
            <button id="submit_add_record" type="submit" class="btn btn-primary" style="width: 20rem;">{{__('save')}}</button>
        </div>
    </form>
</div> -->


@endsection


@section('table_title')
<h1>Lista Usuario</h1>
@endsection




<div class="modal fade" id="user_roles" tabindex="-1" role="dialog" aria-labelledby="userRolesLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content" id="role_user">

        </div>
    </div>
</div>

@section('js')
@if (session('status') == 'success')
<script>
    Swal.fire(
        'Éxito',
        'Se agregó el rol correctamente.',
        'success'
    )
</script>
@endif
@if (session('status') == 'deleted')
<script>
    Swal.fire(
        'Éxito',
        'Se eliminó el usuario correctamente.',
        'success'
    )
</script>
@endif
@vite(['resources/js/modules/user.js'])
@endsection