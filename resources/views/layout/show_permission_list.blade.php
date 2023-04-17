<hr>
<label><strong>Agregar Permisos</strong></label>
<div id="permission_list" class="role-item-group smooth">
    @foreach($permissions as $item)
    <input id="check{{ $loop->iteration }}" value="{{$item->permission_id}}" type="checkbox" name="check[]" />
    <label class="item-align-text" for="check{{ $loop->iteration }}">{{$item->permission_description}}</label>
    @endforeach
</div>