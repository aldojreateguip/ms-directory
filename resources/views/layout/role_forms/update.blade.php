<div id="update_record_box" class="collapse">
    <form id="uform" action="{{url ('role/update')}}" class="needs-validation" novalidate method="POST">
        @csrf
        @method('PUT')
        <div class="role_form">
            <div class="row__center">
                <div class="role-box smooth">
                    <div class="role-item span">
                        <h1 for="urole">{{__('Editar Rol')}}</h1>
                    </div>
                    <div class="role-item smooth">
                        <input type="text" name="uid" id="uid" required>
                        <!-- <input type="text" name="urole" id="urole" class="form-control" autocomplete="off" placeholder="Nombre del rol" required> -->
                        <!-- <input type="text" name="urole" id="urole" class="form-control" autocomplete="off" placeholder="Nombre del rol" required> -->
                        <div class="invalid-feedback">
                            Porfavor completa este campo
                        </div>
                    </div>
                    <div class="role-item smooth">
                        <button id="updateRole" name="updateRole" type="submit" data-toggle="tooltip" data-bs-placement="bottom" title="Guardar Cambios" class="btn btn-info updateRole">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>