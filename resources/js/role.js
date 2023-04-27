/** new record */
$(function () {
    function resetShowRecords() {
        var button = document.getElementById('showDeleted');
        button.checked = false;
        button.classList.add("ena");
        button.classList.remove("disa");
    }
    
    window.onload = function() {
        resetShowRecords();
    };

    $(document).on("click", ".paginate_button", function(){
        resetShowRecords();
    });

    $(document).on("change", ".check_records", function () {
        var label = document.querySelector('label[for="showDeleted"]');
        var button = document.querySelector(".check_records");

        if (button.classList.contains("ena")) {
            label.setAttribute("data-bs-original-title", "Ocultar Eliminados");
            button.classList.remove("ena");
            button.classList.add("disa");

            table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                var data = this.data();
                var status = data.record_state;
                var row = this.nodes();
                if (status === 0) {
                    row.to$().show();
                }
            });
        } else {
            label.setAttribute("data-bs-original-title", "Mostrar Eliminados");
            button.classList.remove("disa");
            button.classList.add("ena");
            table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                var data = this.data();
                var status = data.record_state;
                var row = this.nodes();
                if (status === 0) {
                    row.to$().hide();
                }
            });
        }
    });

    $(document).on("click", ".addbtn", function () {
        // table.ClearTable();
        // tabla.Destroy();

        if ($("#add_record_box").is(":hidden")) {
            $("#add_record_box").addClass("show");
        }
        $("#add_record_box").addClass("show");
        document.getElementById("update_record_box").classList.remove("show");
        document.getElementById("createRole").disabled = true;
        document.getElementById("arole").value = "";
        document.getElementById("uform").reset();
    });

    /* Edit Record */
    $(document).on("click", ".editbtn", function () {
        if ($("#update_record_box").is(":hidden")) {
            $("#update_record_box").addClass("show");
        }
        document.getElementById("add_record_box").classList.remove("show");
        document.getElementById("arole").value = "";
        document.getElementById("uform").reset();
        var record_id = $(this).data("record-id");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "GET",
            url: "get-role-data/" + record_id,
            success: function (response) {
                $("#urole").val(response.role_data.role_description);
                $("#uid").val(response.role_data.role_id);
            },
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

    /** change role state */
    $(document).on("click", ".role_button_state", function () {
        var role_id = this.getAttribute("data-id");
        var role_state = this.getAttribute("data-state");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data: {
                role_id: role_id,
                state: role_state,
            },
            type: "PUT",
            url: "role/change-state/" + role_id,
            success: function (response) {
                resetShowRecords();
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "El estado se cambió correctamente",
                    showConfirmButton: false,
                    timer: 1500,
                });
                table.draw();
            },
            error: function (response) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "ha ocurrido un error inesperado",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
        });
    });

    /** Tooltips */
    $('[data-toggle="tooltip"]').tooltip();
    document.addEventListener("click", function () {
        $('[data-toggle="tooltip"]').tooltip("hide");
    });

    /* Delete Record Fuction */
    $(document).on("click", ".deletebtn", function () {
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
                        table.draw();
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
        });
    });

    /** Form Initialization */
    let add_box = document.querySelector("#add_record_box");
    add_box.classList.add("show");

    /** Dis - Ena CreateRole Button  */
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

    /** Dis - Ena CreateRole Button  */
    var role_description = document.getElementById("urole");
    var update_permission = document.getElementById("updateRole");

    role_description.addEventListener("input", function () {
        if (role_description.value.trim() !== "") {
            update_permission.disabled = false;
        } else {
            update_permission.disabled = true;
        }
    });

    /** Create Permission Function */
    $(document).on("click", "#createRole", function (event) {
        event.preventDefault();

        var role = document.getElementById("arole");
        var role_description = role.value;
        var role_id = document.querySelector("#role_id");
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

                    role_id.setAttribute("value", response.role_id);

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
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.ajax({
                        type: "POST",
                        url: "create-role",
                        // data: $("#aform").serialize(),
                        data: {
                            description: role_description,
                        },
                        success: function (response) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Se registró el rol, asigne sus permisos",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            table.draw();
                            role_id.setAttribute("value", response.role_id);

                            $.ajax({
                                type: "GET",
                                url: "show-permission",
                                data: { role_description: role_description },
                                success: function (response) {
                                    $("#role_list").html(response);
                                    table.draw();
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
        });
    });

    /** Show Permissions */
    $(document).on("click", ".showpermission", function () {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "role/get-permissions/" + id,
            success: function (response) {
                $("#role_user").html(response);
            },
        });
    });

    /** DataTable */
    // table.dataTable().Destroy();
    var table = $("#record_data").DataTable({
        serverSide: true,
        ajax: {
            url: "role/datatable/data",
        },
        columns: [
            {
                title: "Acciones",
                render: function (data, type, full, meta) {
                    if (full.record_state === 1) {
                        return (
                            "<button title='Actualizar' data-toggle='tooltip' data-bs-placement='bottom' data-record-id='" +
                            full.role_id +
                            "' class='action-btn btn-success editbtn'><i class='bi bi-pencil-square'></i></button>" +
                            " <button title='Eliminar' data-record-id='" +
                            full.role_id +
                            "' class='action-btn btn-danger deletebtn'><i class='bi bi-x-square'></i></button>" +
                            " <button title='Ver Permisos' class='action-btn btn-info showpermission'><i class='fa-solid fa-list'></i></button>"
                        );
                    } else {
                        return '<button disabled class="btn btn-secondary">Eliminado</button>';
                    }
                },
            },
            { data: "record_state", title: "EstadoFila", visible: false },
            { data: "role_description", title: "Descripción" },
            {
                data: "role_state",
                title: "Estado",
                render: function (data, type, full, meta) {
                    var state;
                    var btnClass;

                    if (full.role_state === 1) {
                        state = 0;
                        btnClass = "ena";
                    } else {
                        state = 1;
                        btnClass = "disa";
                    }
                    return (
                        "<button title='Habilitado' type='button' data-toggle='tooltip' data-bs-placement='bottom' class='btn role_button_state " +
                        btnClass +
                        "' data-id='" +
                        full.role_id +
                        "' data-state='" +
                        state +
                        "'><i class='bi bi-toggle-on'></i></button>"
                        // "<button>XXXXX</button>"
                    );
                },
            },
        ],
        destroy: true,
        lengthMenu: [
            [5, 10, 50, -1],
            [5, 10, 50, "All"],
        ],
        pagingType: "full_numbers",
        language: {
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json",
        },
    });

    // table.column(1).visible(false);
    table.on("draw.dt", function () {
        table.rows().every(function (rowIdx, tableLoop, rowLoop) {
            var data = this.data();
            var status = data.record_state;
            var row = this.node();

            if (status === 0) {
                this.nodes().to$().hide();
                $(row).addClass("__hidden");
            }
        });
    });
    table.draw();
});
