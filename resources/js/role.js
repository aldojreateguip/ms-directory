/* Register Success*/
$(document).on(function () {
    $(document).on("click", ".editbtn", function () {
        document.getElementById("add_record_box").classList.remove("show");
        document.getElementById("aform").reset();
        document.getElementById("uform").reset();
        var record_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "edit-ubigeo/" + record_id,
            success: function (response) {
                $("#record_id").val(response.ubigeo.ubigeo_id);
                $("#ucountry").val(response.ubigeo.ubigeo_country);
                $("#udepartment").val(response.ubigeo.ubigeo_department);
                $("#umunicipality").val(response.ubigeo.ubigeo_municipality);
            },
        });
    });
});

/** Create Function */
$(function () {
    $(document).on("click", ".addPermission", function () {
        var role = document.getElementById("arole");
        var role_description = role.value;

        if (!role_description) {
            $.ajax({
                data: {
                    _token: "{{ csrf_token() }}",
                },
                type: "GET",
                url: "show-permission",
                success: function (response) {
                    console.log(response);
                    $("#permission_list").html(response);
                },
                error: function (response) {
                    // console.log(response);
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Ha ocurrido un problema con la conexión",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
            });
        } else {
            $.ajax({
                data: {
                    role_description: role_description,
                    _token: "{{ csrf_token() }}",
                },
                type: "GET",
                url: "show-permission",
                success: function (response) {
                    console.log(response);
                    $("#permission_list").html(response);
                },
                error: function (response) {
                    // console.log(response);
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Ha ocurrido un problema con la conexión",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
            });
        }
    });
});

/* input validator */
(() => {
    "use strict";
    const forms = document.querySelectorAll(".needs-validation");

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

/* dataTables */
$(function () {
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

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    document.addEventListener("click", function () {
        $('[data-toggle="tooltip"]').tooltip("hide");
    });
});

/* delete fuction */
var delbtn = document.querySelectorAll(".deletebtn");
for (var i = 0; i < delbtn.length; i++) {
    delbtn[i].addEventListener("click", function () {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡El registro dejará de estar disponible!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).data("record-id");
                $.ajax({
                    url: "delete-role/" + id,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        Swal.fire(
                            "Éxito",
                            "El registro se realizó correctamente.",
                            "success"
                        );
                    },
                    error: function (xhr) {
                        Swal.fire(
                            "Error",
                            "Ocurrió un error al realizar el registro.",
                            "error"
                        );
                    },
                });
            }
        });
    });
}

/** Form Initialization */
$(function () {
    let add_box = document.querySelector("#add_record_box");
    add_box.classList.add("show");
});
