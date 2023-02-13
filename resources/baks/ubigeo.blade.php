@extends('admin_view.dashboard')
@section('content-area')
<!-- Main -->

<div class="card">
    <div class="card-header">
        Lista de ubigeo
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>
                <button class="btn btn-primary add btn-sm" id="add_Register_btn" name="add_Register_btn" data-bs-toggle="modal" data-bs-target="#add_Register">Nuevo Registro</button>
            </p>
            <br>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>{{__('actions')}}</th>
                        <th>{{__('country')}}</th=>
                        <th>{{__('department')}}</th=>
                        <th>{{__('municipality')}}</th=>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ubigeo_data as $item)
                    <tr>
                        <td>
                            <div class="btn-group-xs">
                                <button data-bs-toggle="modal" data-bs-target="#editUbigeo" value="{{$item->ubigeo_id}}" class="action-btn btn-success editbtn">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button data-bs-toggle="modal" data-bs-target="#deleteUbigeo" value="{{$item->ubigeo_id}}" class="action-btn btn-danger deletebtn">
                                    <i class="bi bi-x-square"></i>
                                </button>
                            </div>
                        </td>
                        <td>{{ $item->ubigeo_country}}</td>
                        <td>{{ $item->ubigeo_department}}</td>
                        <td>{{ $item->ubigeo_municipality}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                {!! $ubigeo_data->links() !!}
            </div>
        </div>
    </div>
</div>

<!-- Add Ubigeo Modal -->
<div class="modal fade" id="addUbigeo" data-keyboard="false" tabindex="-1" data-backdrop="static" aria-labelledby="addUbigeoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="forms__content">
            <div class="forms__header">
                <h3 class="modal-title" id="addUbigeoLabel">Ingrese datos de nuevo registro</h3>
            </div>
            <form action="{{ url ('add-ubigeo') }}" class="forms" name="forms" id="forms" method="POST">
                @csrf
                <!-- Group: Country -->
                <div class="forms__group" id="group__country">
                    <label for="country" class="forms__label">{{__('country')}}</label>
                    <div class="forms__group-input">
                        <input type="text" class="forms__input" name="country" id="country" placeholder="Perú">
                        <i class="forms__validation-state bi bi-x-circle-fill"></i>
                    </div>
                    <p class="forms__input-error">Este campo solo puede contener letras</p>
                </div>
                <!-- Group: Department -->
                <div class="forms__group" id="group__department">
                    <label for="department" class="forms__label">{{__('department')}}</label>
                    <div class="forms__group-input">
                        <input type="text" class="forms__input" name="department" id="department" placeholder="Loreto">
                        <i class="forms__validation-state bi bi-x-circle-fill"></i>
                    </div>
                    <p class="forms__input-error">Este campo solo puede contener letras</p>
                </div>
                <!-- Group: Municipality -->
                <div class="forms__group" id="group__municipality">
                    <label for="municipality" class="forms__label">{{__('municipality')}}</label>
                    <div class="forms__group-input">
                        <input type="text" class="forms__input" name="municipality" id="municipality" placeholder="Maynas">
                        <i class="forms__validation-state bi bi-x-circle-fill"></i>
                    </div>
                    <p class="forms__input-error">Este campo solo puede contener letras</p>
                </div>
                <!-- Group: Error Message -->
                <div class="forms__message" id="forms_message">
                    <p><i class="exclamation-icon bi bi-exclamation-octagon-fill"></i>
                        <b>Error:</b>
                        Por favor complete correctamente los campos.
                    </p>
                </div>
                <!-- Group: Buttons -->
                <div class="forms__group forms__group-btn-submit">
                    <button type="submit" class="forms__btn">{{__('save')}}</button>
                    <p class="forms__message-success" id="forms__message-success">success</p>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Add Ubigeo Modal-->

<!-- Edit Ubigeo Modal -->
<div class="modal fade" id="editUbigeo" tabindex="-1" aria-labelledby="editUbigeoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="forms__content">
            <div class="forms__header">
                <h3 class="modal-title" id="editUbigeoLabel">Actualizar datos del registro</h3>
            </div>
            <form action="{{ url ('add-ubigeo') }}" class="forms" name="forms" id="edit_Form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="edit_id" id="edit_id" />
                <!-- Group: Country -->
                <div class="forms__group" id="group__country">
                    <label for="add_country" class="forms__label">{{__('country')}}</label>
                    <div class="forms__group-input">
                        <input type="text" class="forms__input" name="edit_country" id="edit_country" placeholder="Perú">
                        <i class="forms__validation-state bi bi-x-circle-fill"></i>
                    </div>
                    <p class="forms__input-error">Este campo solo puede contener letras</p>
                </div>
                <!-- Group: Department -->
                <div class="forms__group" id="group__department">
                    <label for="add_department" class="forms__label">{{__('department')}}</label>
                    <div class="forms__group-input">
                        <input type="text" class="forms__input" name="edit_department" id="edit_department" placeholder="Loreto">
                        <i class="forms__validation-state bi bi-x-circle-fill"></i>
                    </div>
                    <p class="forms__input-error">Este campo solo puede contener letras</p>
                </div>
                <!-- Group: Municipality -->
                <div class="forms__group" id="group__municipality">
                    <label for="add_municipality" class="forms__label">{{__('municipality')}}</label>
                    <div class="forms__group-input">
                        <input type="text" class="forms__input" name="edit_municipality" id="edit_municipality" placeholder="Maynas">
                        <i class="forms__validation-state bi bi-x-circle-fill"></i>
                    </div>
                    <p class="forms__input-error">Este campo solo puede contener letras</p>
                </div>
                <!-- Group: Error Message -->
                <div class="forms__message" id="forms_message">
                    <p><i class="exclamation-icon bi bi-exclamation-octagon-fill"></i>
                        <b>Error:</b>
                        Por favor complete correctamente los campos.
                    </p>
                </div>
                <!-- Group: Buttons -->
                <div class="forms__group forms__group-btn-submit">
                    <button type="submit" class="forms__btn">{{__('update')}}</button>
                    <p class="forms__message-success" id="forms__message-success">success</p>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Edit Ubigeo Modal -->

<!-- Delete Ubigeo Modal -->
<div class="modal fade" id="deleteUbigeo" tabindex="-1" aria-labelledby="deleteUbigeoLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ url ('delete-ubigeo') }}" method="POST" id="deleteUbigeoForm">
                @csrf
                @method('DELETE')

                <input type="hidden" name="delete_id" id="delete_id">

                <h5 class="message center" id="deleteUbigeoLabel">¿Desea eliminar el registro?</h5>
                <div class="modal-footer btn-group center">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="2">{{__('delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Delete Ubigeo Modal -->

@endsection

@section('scripts')
<!-- alerts -->
<script>
    $('#addUbigeo').on('hidden.bs.modal', function() {
        document.getElementById("forms").reset();
    })

    $('#editUbigeo').on('hidden.bs.modal', function() {
        document.getElementById("edit_Form").reset();
    })
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.deletebtn', function() {
            var ubigeo_id = $(this).val();
            $('#delete_id').val(ubigeo_id);
            console.log()
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
            var ubigeo_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "edit-ubigeo/" + ubigeo_id,
                success: function(response) {
                    //console.log(response.ubigeo.ubigeo_country);
                    $('#edit_id').val(response.ubigeo.ubigeo_id);
                    $('#edit_country').val(response.ubigeo.ubigeo_country);
                    $('#edit_department').val(response.ubigeo.ubigeo_department);
                    $('#edit_municipality').val(response.ubigeo.ubigeo_municipality);
                }
            });
        });
    });
</script>

<!-- table hover scripts-->
<!-- <script type="text/javascript">
    (function($) {
        "use strict";
        $('.pad').on('mouseover', function() {
            var table1 = $(this).parent().parent().parent();
            var table2 = $(this).parent().parent();
            var column = $(this).data('column') + "";
            $(table2).find("." + column).addClass('hov-column-custom');
            $(table1).find(".custom-row.head ." + column).addClass('hov-column-head-custom');
        });
        $('.pad').on('mouseout', function() {
            var table1 = $(this).parent().parent().parent();
            var table2 = $(this).parent().parent();
            var column = $(this).data('column') + "";
            $(table2).find("." + column).removeClass('hov-column-custom');
            $(table1).find(".custom-row.head ." + column).removeClass('hov-column-head-custom');
        });
    })(jQuery);
</script> -->
@vite(['resources/js/forms.js'])
@endsection