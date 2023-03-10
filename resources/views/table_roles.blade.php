@foreach($filteredData as $roles)
<tr>
    <td>{{$roles->user_id}}</td>
    <td>{{$roles->role_id}}</td>
    <td>{{$roles->role_description}}</td>
</tr>
@endforeach