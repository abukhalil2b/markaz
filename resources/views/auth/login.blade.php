<x-layouts.guest>

    <style>
        .input-container {
            position: relative;
        }

        .showPassword {
            position: absolute;
            left: 5px;
            top: 5px;
            cursor: pointer;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- email Address -->
        <div>
            المستخدم  
            <x-text-input class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="' كلمة المرور '" />
            <div class="input-container">
                <span onclick="showPassword()" class="showPassword">اظهار</span>
                <input  name="password" type="password" id="passwordInput" class="form-input"  placeholder="كلمة المرور">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded  border-gray-300 " name="remember">
                <span class="mr-2 text-sm text-gray-600 dark:text-gray-400">
                    تذكرني
                </span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-3 w-full">
                تسجيل الدخول
            </x-primary-button>
        </div>
    </form>
    <script>
        function showPassword() {
            var input = document.getElementById('passwordInput');
            if (input.type == 'text') {
                input.type = 'password'
            } else if (input.type == 'password') {
                input.type = 'text'
            }
        }
    </script>


</x-layouts.guest>