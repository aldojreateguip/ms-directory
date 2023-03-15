@extends('layout.load_table')
@section('title', 'Usuario')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

@endsection

@section('forms')
<div id="add_record_box" class="collapse">
    <form id="aform" action="{{url ('add-user')}}" class="needs-validation" novalidate method="POST">
        <!-- <form id="aform" action="{{url ('add-user')}}" method="POST"> -->
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
</div>

<div id="update_record_box" class="collapse">
    <form id="uform" action="{{url ('update-user')}}" class="needs-validation" novalidate method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="record_id" id="record_id">
        <div class="crud-content">
            <div class="col">
                <label for="upassword">{{__('Password')}}</label>
                <input type="text" name="upassword" id="upassword" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete or enter a valid password
                </div>
            </div>

            <div class="col">
                <label for="ustate">{{__('state')}}</label>
                <input type="number" name="ustate" id="ustate" class="form-control" required>
                <div class="invalid-feedback">
                    Please complete this field
                </div>
            </div>
        </div>
        <div class="row-md" style="display: flex; justify-content: center;">
            <button id="submit_update_record" type="submit" value="submit" class="btn btn-success" style="width: 20rem;">{{__('update')}}</button>
        </div>
    </form>
</div>
@endsection


@section('table_title')
<h1>Lista Usuario</h1>
@endsection

@section('head_data')
<tr>
    <th>{{__('actions')}}</th>
    <th>{{__('Estado')}}</th>
    <th>{{__('Nombre')}}</th>
    <th>{{__('Roles')}}</th>
</tr>
@endsection

@section('row_data')
@foreach($data as $item)
<tr>
    <td>
        <button title="Actualizar" data-toggle="tooltip" data-bs-placement="bottom" value="{{$item->user_id}}" class="action-btn btn-success editbtn" data-bs-toggle="collapse" data-bs-target="#update_record_box" aria-controls="update_record_box" aria-expanded="false">
            <i class="bi bi-pencil-square"></i>
        </button>
        <button title="Eliminar" data-toggle="tooltip" data-bs-placement="bottom" data-record-id="{{$item->user_id}}" class="action-btn btn-danger deletebtn">
            <i class="bi bi-x-square"></i>
        </button>
    </td>
    <td>
        @if($item->user_state == 1)
        Habilitado
        @else
        Deshabilitado
        @endif
    </td>
    <td>{{ $item->person_name}} {{$item->person_surname}}</td>
    <td>
        <button type="button" data-toggle="tooltip" data-bs-placement="bottom" title="Ver Roles" value="{{$item->user_id}}" class="action-btn btn-info roles" data-bs-toggle="modal" data-bs-target="#user_roles" aria-controls="user_roles" aria-expanded="false">
            <i class="bi bi-file-earmark-person-fill"></i>
        </button>
    </td>
</tr>
@endforeach



@endsection

@yield('filldata')
<div class="modal fade" id="user_roles" tabindex="-1" role="dialog" aria-labelledby="userRolesLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content" id="role_user">

        </div>
    </div>
</div>

@section('js')
@vite(['resources/js/views/user.js'])
@endsection