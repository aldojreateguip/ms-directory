<section class="content-header">
    <div class="container-fluid">
        <h1>
            <button type="button" class="btn-info btn-sm addbtn" id="addbtn" data-bs-toggle="collapse" data-bs-target="#add_record_box" aria-controls="add_record_box" aria-expanded="false">
                <i class="fa-solid fa-square-plus"></i>
                <span>Nuevo Registro</span>
            </button>
        </h1>
        <hr>
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
                                        @yield('head_data')
                                    </thead>
                                    <tbody>
                                        @yield('row_data')
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
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

<!--translated tags-->
<script>
    $(document).ready(function() {
        table = $('#record_data').DataTable({
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
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.addbtn', function() {
            document.getElementById('update_record_box').classList.remove("show");
            document.getElementById('aform').classList.remove("was-validated");
            document.getElementById('uform').classList.remove("was-validated");
            document.getElementById('aform').reset();
            document.getElementById('uform').reset();
        });
    });
</script>