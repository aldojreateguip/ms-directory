$(function () {
    //init dataTable
    // $('[data-toggle="tooltip"]').tooltip();
    // document.addEventListener("click", function () {
    //     $('[data-toggle="tooltip"]').tooltip("hide");
    // });
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

    //Update record
    // $(document).on("click", ".editbtn", function () {
    //     document.getElementById("add_record_box").classList.remove("show");
    //     document.getElementById("update_record_box").classList.add("show");
    //     document.getElementById("aform").classList.remove("was-validated");
    //     document.getElementById("uform").classList.remove("was-validated");
    //     document.getElementById("aform").reset();
    //     document.getElementById("uform").reset();
    //     var record_id = $(this).data("record-id");
    //     $.ajax({
    //         type: "GET",
    //         url: "user/find/" + record_id,
    //         success: function (response) {
    //             $("#record_id").val(response.user.user_id);
    //             $("#ustate").val(response.user.user_state);
    //             $("#uroleid").val(response.user.role_id);
    //             $("#upersonid").val(response.user.person_id);
    //         },
    //     });
    // });

    //Update record
    $(document).on("click", ".resetbtn", function () {
        document.getElementById("aform").classList.remove("was-validated");
        document.getElementById("aform").reset();
        var record_id = $(this).data("record-id");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "PUT",
            url: "user/reset/" + record_id,
            success: function (response) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "el usuario se ha resetado exitosamente",
                    showConfirmButton: false,
                    timer: 1500,
                });
                table.draw();
            },
            error: function (xhr) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Ocurrió un error inesperado",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
        });
    });

    //get roles
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

    //change role state
    $(document).on("click", ".role_button_state", function () {
        var id = this.getAttribute("data-id");
        var state = this.getAttribute("data-state");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            data: {
                state: state,
            },
            type: "PUT",
            url: "user/change/state/" + id,
            success: function (response) {
                $("#role_user").html(response);
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "El estado se cambió con éxito",
                    showConfirmButton: false,
                    timer: 1500,
                });
                table.draw();
            },
            error: function (response) {
                alert("FAIL");
            },
        });
    });

    //Delete record
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
                    url: "user/delete/" + id,
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

    /** new record */
    $(document).on("click", ".addbtn", function () {
        if ($("#add_record_box").is(":hidden")) {
            $("#add_record_box").addClass("show");
        }
        $("#add_record_box").addClass("show");
        document.getElementById("update_record_box").classList.remove("show");
        document.getElementById("uform").reset();
        document.getElementById("aform").reset();
    });

    //show roles to add
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

    /** DataTable */
    var table = $("#record_data").DataTable({
        serverSide: true,
        ajax: {
            url: "user/datatable/data",
        },
        columns: [
            {
                title: "Acciones",
                render: function (data, type, full, meta) {
                    if (full.record_state === 1) {
                        return (
                            "<button title='Resetear' data-toggle='tooltip' data-bs-placement='bottom' data-record-id='" +
                            full.user_id +
                            "' class='action-btn btn-success resetbtn'><i class='fa-solid fa-rotate-right'></i></button>" +
                            " <button title='Eliminar' data-record-id='" +
                            full.user_id +
                            "' class='action-btn btn-danger deletebtn'><i class='bi bi-x-square'></i></button>"
                        );
                    } else {
                        return '<button disabled class="btn btn-secondary">Eliminar</button>';
                    }
                },
            },
            { data: "record_state", title: "EstadoFila", visible: false },
            {
                data: "email",
                title: "Usuario",
            },
            {
                data: null,
                title: "Nombre de usuario",
                render: function (data, type, row) {
                    return row.person_name + " " + row.person_surname;
                  }
            },
            {
                title: "Estado",
                render: function (data, type, full, meta) {
                    var state;
                    var btnClass;

                    if (full.user_state === 1) {
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
                        full.user_id +
                        "' data-state='" +
                        state +
                        "'><i class='bi bi-toggle-on'></i></button>"
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

});

