<section class="content-header">
    <div class="container-fluid">
        @yield('table_title')
        <br>
        <button type="button" class="btn btn-primary" id="add_btn_record" name="add_btn_record" data-bs-toggle="modal" data-bs-target="#addRecord">
            <i class="fa-solid fa-square-plus"></i>
            <span>Agregar Registro</span>
        </button>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        @yield('head_data')
                                    </thead>
                                    <tbody>
                                        @yield('row_data')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    @yield('pagination')
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>