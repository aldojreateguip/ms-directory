/* Edit Record Success*/
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
        destroy: true,
        scrollX: true,
        lengthMenu: [
            [5, 10, 50, -1],
            [5, 10, 50, "All"],
        ],
        pagingType: "full_numbers",
        language: {"url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"},
    });
});

/** Tooltips */
$(function () {
    Data_Table();
    $('[data-toggle="tooltip"]').tooltip();
    document.addEventListener("click", function () {
        $('[data-toggle="tooltip"]').tooltip("hide");
    });
});

/* Delete Record Fuction */
$(function () {
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
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.ajax({
                        url: "delete-role/" + id,
                        type: "PUT",
                        success: function (response) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Se eliminó correctamente",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            location.reload();
                        },
                        error: function (xhr) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "ha ocurrido un error inesperado",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            Data_Table();
                        },
                    });
                }
            });
        });
    }
});

/** Form Initialization */
$(function () {
    let add_box = document.querySelector("#add_record_box");
    add_box.classList.add("show");
});

/** Dis - Ena CreateRole Button  */
$(function () {
    var role_description_input = document.getElementById("arole");
    var show_permission_btn = document.getElementById("createRole");
    var permission_list = document.getElementById("role_list");

    role_description_input.addEventListener("input", function () {
        if (role_description_input.value.trim() !== "") {
            show_permission_btn.disabled = false;
        } else {
            show_permission_btn.disabled = true;
            permission_list.innerHTML = "";
        }
    });
});

/** Create Permission Function */
$(function () {
    $(document).on("click", "#createRole", function (event) {
        event.preventDefault();

        var role = document.getElementById("arole");
        var role_description = role.value;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        /** check */
        $.ajax({
            type: "GET",
            url: "check-role",
            data: { description: role_description },
            success: function (response) {
                if (response.status === "exists") {
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        title: "Rol existente, puede agregarle más permisos",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    $.ajax({
                        type: "GET",
                        url: "show-permission",
                        data: { role_description: role_description },
                        success: function (response) {
                            $("#role_list").html(response);
                        },
                        error: function (xhr) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "ha ocurrido un error inesperado",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        },
                    });
                } else {
                    /** create */
                    $.ajax({
                        type: "POST",
                        url: "create-role",
                        data: $("#aform").serialize(),
                        success: function (response) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Se registró el rol, asigne sus permisos",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $.ajax({
                                type: "GET",
                                url: "show-permission",
                                data: { role_description: role_description },
                                success: function (response) {
                                    $("#role_list").html(response);
                                },
                                error: function (xhr) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "error",
                                        title: "ha ocurrido un error inesperado",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                },
                            });
                        },
                        error: function (xhr) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "ha ocurrido un error inesperado",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        },
                    });
                }
            },
            error: function (xhr) {
                console.log("error");
            },
            // beforeSend: function (data) {
            //     console.log("data: ", data);
            // },
        });
    });
});
