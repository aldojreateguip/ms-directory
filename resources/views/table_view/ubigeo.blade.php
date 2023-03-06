@extends('load_table_layout')
@php
$method_forms = 'POST'
@endphp


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('forms')
<div>
    <form id="aform" action="{{url ('add-ubigeo')}}" class="needs-validation" novalidate method="POST">
        @csrf
        <div class="crud-content">
            <div class="col-4">
                <label for="country">{{__('country')}}</label>
                <input type="text" name="acountry" id="acountry" class="form-control" onkeydown="return alphaOnly(event);" required>
                <div class="invalid-feedback">
                    Please enter only letters
                </div>
            </div>

            <div class="col-4">
                <label for="department">{{__('department')}}</label>
                <input type="text" name="adepartment" id="adepartment" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter only letters
                </div>
            </div>

            <div class="col-md-4">
                <label for="municipality">{{__('municipality')}}</label>
                <input type="text" name="amunicipality" id="amunicipality" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter only letters
                </div>
            </div>
        </div>
        <div class="row-md" style="display: flex; justify-content: center;">
            <button type="submit" value="submit" class="btn btn-primary" style="width: 20rem;">{{__('save')}}</button>
        </div>
    </form>
</div>

<div>
    <form id="uform" action="{{url ('update-ubigeo')}}" class="needs-validation hidden_form" novalidate method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="record_id" id="record_id">
        <div class="crud-content">
            <div class="col-4">
                <label for="country">{{__('country')}}</label>
                <input type="text" name="ucountry" id="ucountry" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter only letters
                </div>
            </div>

            <div class="col-4">
                <label for="department">{{__('department')}}</label>
                <input type="text" name="udepartment" id="udepartment" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter only letters
                </div>
            </div>

            <div class="col-md-4">
                <label for="municipality">{{__('municipality')}}</label>
                <input type="text" name="umunicipality" id="umunicipality" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter only letters
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
<h1>Lista Ubigeo</h1>
@endsection

@section('head_data')
<tr>
    <th>{{__('actions')}}</th>
    <th>{{__('country')}}</th>
    <th>{{__('department')}}</th>
    <th>{{__('municipality')}}</th>
</tr>
@endsection

@section('row_data')
@foreach($ubigeo_data as $item)
<tr>
    <td>
        <button title="Actualizar" value="{{$item->ubigeo_id}}" class="action-btn btn-success editbtn">
            <i class="bi bi-pencil-square"></i>
        </button>
        <button title="Eliminar" value="{{$item->ubigeo_id}}" class="action-btn btn-danger deletebtn">
            <i class="bi bi-x-square"></i>
        </button>
    </td>
    <td>{{ $item->ubigeo_country}}</td>
    <td>{{ $item->ubigeo_department}}</td>
    <td>{{ $item->ubigeo_municipality}}</td>
</tr>
@endforeach
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
            document.getElementById('aform').classList.add("hidden_form")
            document.getElementById('uform').classList.remove("hidden_form")

            var record_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "edit-ubigeo/" + record_id,
                success: function(response) {
                    console.log(response);
                    $('#record_id').val(response.ubigeo.ubigeo_id);
                    $('#ucountry').val(response.ubigeo.ubigeo_country);
                    $('#udepartment').val(response.ubigeo.ubigeo_department);
                    $('#umunicipality').val(response.ubigeo.ubigeo_municipality);
                }
            });
        });
    });
</script>

<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection