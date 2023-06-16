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
        <div class="table-title">
            @yield('table_title')

            <label for="showDeleted" title="Mostar Eliminados" data-toggle="tooltip" data-bs-placement="bottom" class="switch">
                <input id="showDeleted" type="checkbox" class="check_records ena">
                <span class="slider"></span>
            </label>
        </div>
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
                                <table id="record_data" class="hover display responsive stripe order-column compact" style="width: 100%;">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>año</th>
                                        </tr>
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