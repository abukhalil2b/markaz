<x-app-layout>
    <div class="font-semibold text-xl text-gray-800 leading-tight">
        {{$user->full_name}}
    </div>

    <form action="{{route('admin.user.update_password',$user->id)}}" method="post">
        @csrf
        <input class="form-input" name="password" placeholder="الرقم السري">
        <button class="mt-5 btn btn-outline-secondary w-100">حفظ</button>
    </form>


</x-app-layout>