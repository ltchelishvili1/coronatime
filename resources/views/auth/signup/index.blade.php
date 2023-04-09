<x-auth-layout>
    <div class="lg:w-2/3 max-w-2/3">
        <h1 class="font-black text-2xl">Welcome to Coronatime</h1>
        <h5 class="my-4 text-zinc-400 text-xl">Please enter required info to sign up</h5>
        <x-form.input name='Username' />
        <x-form.input name='Email' />
        <x-form.input name='Password' />
        <x-form.input name='Repeat Password' />
        <div class="flex items-center justify-between">
            <label for="remember-me" class="inline-flex items-center mt-6 ">
                <input id="remember-me" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
                <span class="ml-2 text-black-100 font-medium text-sm">Remember this device</span>
            </label>
        </div>
        <div class="w-full">
            <x-form.button>
                Sign Up
            </x-form.button>
        </div>
        <div class="w-full flex items-center justify-center mt-6">
            <p ><span class="text-zinc-400">Already have an account? </span><a href="{{route('login')}}" class="font-bold"> Log in</a></p>
        </div>
    </div>
</x-auth-layout>
