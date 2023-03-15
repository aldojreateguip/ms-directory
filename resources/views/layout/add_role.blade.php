<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<div class="modal-content">
    <div class="modal-header bg-primary">
        <h3 class="modal-title">
            {{$user_info->person_name}} : Añadir rol
        </h3>
    </div>
    <div class="modal-body">
        <div class="card">
            <div class="card-body table-responsive p-0" style="height: 300px;">

                <table id="user_roles_data" class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>{{__('Estado')}}</th>
                            <th>{{__('Descripción')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                            <input type="text" class="control-form">
                        </td>
                        <td>
                            <div class="control-group">
                                <label for="description"></label>
                                <input type="text" id="description"  class="control-form">
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div>
</div>