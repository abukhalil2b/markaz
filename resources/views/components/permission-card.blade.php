@props(['permission','role'])
<label class="bg-white my-1 border rounded p-2 flex justify-between hover:bg-transparent">
    <div>
        <input type="checkbox" name="permission_ids[]" value="{{$permission->id}}" {{$role->canPermission($permission->slug)?'checked':''}}>
        {{$permission->name}}
    </div>
    <div>
        {{$permission->slug}}
    </div>
</label>