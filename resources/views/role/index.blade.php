<x-app-layout>
    <div x-data="{ createPermission:false }">
        <div @click="createPermission = !createPermission" class="font-bold w-32 btn-option " :class=" createPermission && 'btn-option-selected' ">
            + صلاحيات جديدة
        </div>


        <div x-cloak x-show=" ! createPermission ">

            @foreach($roles as $role)

            <a class="w-full rounded border bg-gray-50 mt-1 p-1 flex justify-start items-center" href="{{route('role.permission.index',['id'=>$role->id])}}">
                {{$role->name}}
            </a>

            @endforeach

        </div>

        <div x-cloak x-show=" createPermission " class="p-3">
        permission.create-component
        permission.index-component
        </div>
    </div>
</x-app-layout>