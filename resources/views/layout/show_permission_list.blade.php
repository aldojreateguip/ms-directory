<label><strong>Agregar Permisos</strong></label>
<div id="permission_list" class="role-item-group smooth">
    @foreach($permissions as $item)
    <input id="check{{ $loop->iteration }}" value="{{$item->permission_id}}" type="checkbox" name="permission[]" />
    <label class="item-align-text" for="check{{ $loop->iteration }}">{{$item->permission_description}}</label>
    @endforeach
</div>
<br>
<button id="savePermissions" disabled type="submit" class="btn-secondary btn-sm" data-toggle="tooltip" data-bs-placement="right">
    Guardar
</button>

<script>
    /** Validate Permissions checkbox */
    var roleCheckBoxes = document.querySelectorAll("input[type=checkbox]");
    var roleSubmit = document.querySelector("#savePermissions");

    function checkRoleCheckBoxes() {
        let checked = false;

        roleCheckBoxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checked = true;
            }
        });
        if (checked) {
            roleSubmit.disabled = false;
            roleSubmit.classList.remove("btn-secondary");
            roleSubmit.classList.add("btn-primary");
        } else {
            roleSubmit.disabled = true;
            roleSubmit.classList.add("btn-secondary");
            roleSubmit.classList.remove("btn-primary");
        }
    }
    roleCheckBoxes.forEach((checkbox) => {
        checkbox.addEventListener("change", checkRoleCheckBoxes);
    });
</script>