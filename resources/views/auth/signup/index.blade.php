<x-auth-layout>
    <div class="lg:w-2/3 max-w-2/3">
        <h1 class="font-black text-2xl">Welcome to Coronatime</h1>
        <h5 class="my-4 text-zinc-400 text-xl">Please enter required info to sign up</h5>
        <form method="POST" action="{{route('register.store')}}" >
            @csrf
            <x-form.input name='username' placeholder='Enter unique username' />
            <x-form.input name='email' type='email' placeholder='Enter your email' />
            <x-form.input name='password' type='password' placeholder='Fill in password' />
            <x-form.input name='repeat_password' type='password' placeholder='Repeat password' />
            
            <div class="w-full">
                <x-form.button>
                    Sign Up
                </x-form.button>
            </div>
        </form>
        <div class="w-full flex items-center justify-center mt-6">
            <p><span class="text-zinc-400">Already have an account? </span><a href="{{route('login')}}"
                    class="font-bold"> Log in</a></p>
        </div>
    </div>
</x-auth-layout>