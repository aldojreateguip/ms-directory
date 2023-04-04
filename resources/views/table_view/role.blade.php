@extends('layout.load_table')

@section('title', 'Roles')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('forms')
<div id="add_record_box" class="collapse">
    <form id="aform" action="{{url ('add-ubigeo')}}" class="needs-validation" novalidate method="POST">
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
                            <button type="button" data-toggle="tooltip" data-bs-placement="bottom" data-bs-toggle="collapse" data-bs-target="#role-list" aria-controls="add_record_box" aria-expanded="false" title="Agregar permiso" class="btn btn-success">
                                <i class="fa-solid fa-file-circle-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="role-list" class="role-item span smooth collapse">
                        <hr>
                        <label><strong>Lista de permisos</strong></label>
                        <div class="role-item-group">
                            @foreach($permission as $item)
                            <input value="{{$item->permission_id}}" type="checkbox">
                            <input type="text" value="{{$item->permission_description}}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row__center">
                <button type="submit" class="btn btn-primary create_role_btn">{{__('save')}}</button>
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
    <th>{{__('Permisos')}}</th>
</tr>
@endsection

@section('row_data')
@foreach($roles as $role)
<tr>
    <td>
        <button title="Actualizar" data-toggle="tooltip" data-bs-placement="bottom" value="{{$role->role_id}}" class="action-btn btn-success editbtn" data-bs-toggle="collapse" data-bs-target="#update_record_box" aria-controls="update_record_box" aria-expanded="false">
            <i class="bi bi-pencil-square"></i>
        </button>
        <button title="Eliminar" data-toggle="tooltip" data-bs-placement="bottom" value="{{$role->role_id}}" class="action-btn btn-danger deletebtn">
            <i class="bi bi-x-square"></i>
        </button>
    </td>
    <td>{{ $role->role_description}}</td>
    <td></td>
</tr>
@endforeach
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
            document.getElementById('add_record_box').classList.remove("show");
            document.getElementById('aform').reset();
            document.getElementById('uform').reset();
            var record_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "edit-ubigeo/" + record_id,
                success: function(response) {
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
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(document).click(function() {
            $('[data-toggle="tooltip"]').tooltip("hide");
        });

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
        })();

        table.destroy();

        table = $("#record_data").DataTable({
            scrollX: true,
            lengthMenu: [
                [5, 10, 50, -1],
                [5, 10, 50, "All"],
            ],
            pagingType: "full_numbers",
            language: {
                decimal: ",",
                thousands: ".",
                info: "Mostrando _START_ al _END_ de _TOTAL_",
                infoEmpty: "Mostrando 0 de 0 - total 0",
                infoPostFix: "",
                infoFiltered: "(total registros: _MAX_)",
                loadingRecords: "Cargando...",
                lengthMenu: "Mostrar _MENU_ registros",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior",
                },
                processing: "Procesando...",
                search: "Buscar:",
                searchPlaceholder: "Término de búsqueda",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "Ningún dato disponible en esta tabla",
                aria: {
                    sortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente",
                },
                //only works for built-in buttons, not for custom buttons
                buttons: {
                    create: "Nuevo",
                    edit: "Cambiar",
                    remove: "Borrar",
                    copy: "Copiar",
                    csv: "fichero CSV",
                    excel: "tabla Excel",
                    pdf: "documento PDF",
                    print: "Imprimir",
                    colvis: "Visibilidad columnas",
                    collection: "Colección",
                    upload: "Seleccione fichero....",
                },
                select: {
                    rows: {
                        _: "%d filas seleccionadas",
                        0: "clic fila para seleccionar",
                        1: "una fila seleccionada",
                    },
                },
            },
        });
    });

    $(document).ready(function() {
        $(document).on("click", ".deletebtn", function() {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡El registro dejará de estar disponible, indefinidamente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                // si el usuario confirma la eliminación, realiza la acción
                if (result.isConfirmed) {
                    var id = $(this).data("record-id");
                    $.ajax({
                        url: "delete-user/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert("Success");
                        },
                        error: function(xhr) {
                            alert("FAIL");
                        },
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        // $(document).on("click", ".create_role_btn", function(elem) {
        //     elem.preventDefault();
        //     Swal.fire({
        //         title: "¿Estás seguro?",
        //         text: "¡El registro dejará de estar disponible, indefinidamente!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Sí, eliminarlo",
        //         cancelButtonText: "Cancelar",
        //     }).then((result) => {
        //         // si el usuario confirma la eliminación, realiza la acción
        //         if (result.isConfirmed) {
        //             var id = $(this).data("record-id");
        //             $.ajax({
        //                 url: "delete-user/" + id,
        //                 type: "DELETE",
        //                 data: {
        //                     _token: "{{ csrf_token() }}",
        //                 },
        //                 success: function(response) {
        //                     alert("Success");
        //                 },
        //                 error: function(xhr) {
        //                     alert("FAIL");
        //                 },
        //             });
        //         }
        //     });
        // });
    });
</script>
<script>
    window.onload = function() {
        add_box = document.getElementById("add_record_box")
        add_box.classList.add("show");
    }
</script>
@endsection