<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<div class="modal-content">
    <div class="modal-header bg-primary">
        <h3 class="modal-title">
            {{$user_info->person_name}} : Roles
        </h3>
    </div>
    <div class="modal-body">
        <button type="button" class="btn-success btn-sm" data-user="" data-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-plus-square-fill"></i> Añadir seleccionados
        </button>
        <br></br>
        <div class="card">
            <div class="card-body table-responsive p-0" style="height: 300px;">

                <table id="user_roles_data" class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>{{__('Elegir')}}</th>
                            <th>{{__('Descripción del rol')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rolelist as $role)
                        <tr>
                            <td class="center-check">
                                <input type="checkbox" class="control-form" />
                            </td>
                            <td>
                                {{$role->role_description}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div>
</div>

