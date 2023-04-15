<x-auth-layout>
    <div class="lg:w-2/3 max-w-2/3">
        <h1 class="font-black text-2xl">Welcome back</h1>
        <h5 class="my-4 text-zinc-400 text-xl">Welcome back! please enter your details</h5>
        <form method="POST" action="{{route('login.post')}}">
            @csrf
            <x-form.input name='username' placeholder='Enter unique username or email' />
            <x-form.input name='password' type='password' placeholder='Fill in password' />
            <div class="flex items-center justify-between">
                <label for="remember-me" class="inline-flex items-center mt-6 ">
                    <input id="remember-me" name="remember_me" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="1">
                    <span class="ml-2 text-black-100 font-medium text-sm">Remember this device</span>
                </label>
                
                <div class="inline-flex items-center mt-6 ">
                    <a href="{{route('password.resetrequest')}}" class="text-blue-600 font-medium text-sm">Forgot
                        Password?</a>
                </div>
            </div>
            <div class="w-full">
                <x-form.button>
                    LOG IN
                </x-form.button>
            </div>
        </form>
        <div class="w-full flex items-center justify-center mt-6">
            <p><span class="text-zinc-400">Don’t have and account? </span><a href="{{route('register')}}"
                    class="font-bold">Sign up for free</a></p>
        </div>
    </div>
</x-auth-layout>