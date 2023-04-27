<section class="content-header">
    <div class="container-fluid">
        <h1>
            <button type="button" class="btn-info btn-sm addbtn" name="addbtn" id="addbtn">
                <i class="fa-solid fa-square-plus"></i>
                <span>Nuevo Registro</span>
            </button>
        </h1>
        @yield('forms')
        <hr>
        @yield('table_title')
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="dataTables_wrapper">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="record_data" class="hover display stripe order-column compact">
                                    <thead class="bg-primary text-white">
                                    </thead>
                                    <tbody id="row_data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@vite(['resources/js/forms.js'])

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!--translated tags-->
<!-- <script>
    $(document).ready(function() {
        table = $('#record_data').DataTable({
            serverSide: true,
            ajax: "{{url('role/datatable/data')}}",
            columns: [
                {
                    title: 'column 1',
                    render: function(data, type, full, meta) {
                        if (full.record_state === 1) {
                            return "<button title='Actualizar' data-toggle='tooltip' data-bs-placement='bottom' data-record-id='"+full.role_id+"' class='action-btn btn-success editbtn'><i class='bi bi-pencil-square'></i></button>" +
                                " <button title='Eliminar' class='action-btn btn-danger deletebtn'><i class='bi bi-x-square'></i></button>" +
                                " <button title='Ver Permisos' class='action-btn btn-info showpermission'><i class='fa-solid fa-list'></i></button>"
                        } else {

                            return '<button disabled class="btn btn-secondary">Eliminado</button>';

                        }
                    }
                },
                {
                    data: 'record_state', title: 'column 2'
                },
                {
                    data: 'role_description', title: 'column 3'
                },

                {
                    data: 'role_state', title: 'column 4'
                }

            ],
            destroy: true,
            lengthMenu: [
                [5, 10, 50, -1],
                [5, 10, 50, "All"]
            ],
            pagingType: 'full_numbers',
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json",
            },
        });
    });
</script> -->