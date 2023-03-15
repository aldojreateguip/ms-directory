//init dataTable
$(document).ready(function () {
    //tooltip
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $(document).click(function () {
            $('[data-toggle="tooltip"]').tooltip("hide");
        });
    });

    //Forms Validation
    (() => {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                "submit",
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
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
                sortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sortDescending:
                    ": Activar para ordenar la columna de manera descendente",
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

//Update record
$(document).ready(function () {
    $(document).on("click", ".editbtn", function () {
        document.getElementById("add_record_box").classList.remove("show");
        document.getElementById("aform").classList.remove("was-validated");
        document.getElementById("uform").classList.remove("was-validated");
        document.getElementById("aform").reset();
        document.getElementById("uform").reset();
        var record_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "edit-user/" + record_id,
            success: function (response) {
                $("#record_id").val(response.user.user_id);
                $("#ustate").val(response.user.user_state);
                $("#uroleid").val(response.user.role_id);
                $("#upersonid").val(response.user.person_id);
            },
        });
    });
});

//get roles
$(document).ready(function () {
    $(document).on("click", ".roles", function () {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "user/get-roles/" + id,
            success: function (response) {
                $("#role_user").html(response);
            },
        });
    });
});

//change role state
$(document).ready(function () {
    $(document).on("click", ".role_button_state", function () {
        var ur_id = this.getAttribute("data-id");
        var user_id = this.getAttribute("data-user");
        var state = this.getAttribute("data-state");

        $.ajax({
            data: {
                ur_id: ur_id,
                user_id: user_id,
                state: state,
                _token: "{{ csrf_token() }}",
            },
            type: "PUT",
            url: "user/change_role/" + ur_id,
            success: function (response) {
                $("#role_user").html(response);
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "El estado se cambió con éxito",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
            error: function (response) {
                alert("FAIL");
            },
        });
    });
});

//Delete record
$(document).ready(function () {
    $(document).on("click", ".deletebtn", function () {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡Eliminarás todos los roles asginados a este usuario!",
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
                    success: function (response) {
                        alert("Success");
                    },
                    error: function (xhr) {
                        alert("FAIL");
                    },
                });
            }
        });
    });
});

//show roles to add
$(document).ready(function () {
    $(document).on("click", ".addrol", function () {
        var user_id = this.getAttribute("data-user");
        $.ajax({
            type: "GET",
            url: "user/show_add_role",
            data: {
                user_id: user_id,
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                $("#role_user").html(response);
            },
        });
    });
});
