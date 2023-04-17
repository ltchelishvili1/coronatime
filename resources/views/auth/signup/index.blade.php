<x-auth-layout>
    <div class="lg:w-2/3 max-w-2/3">
        <h1 class="font-black text-2xl">{{__('signup.title')}}</h1>
        <h5 class="my-4 text-zinc-400 text-xl">{{__('signup.description')}}</h5>
        <form method="POST" action="{{route('register.post')}}" >
            @csrf
            <x-form.input name='username' placeholder="{{__('placeholder.username')}}" />
            <x-form.input name='email' type='email' placeholder="{{__('placeholder.email')}}" />
            <x-form.input name='password' type='password' placeholder="{{__('placeholder.password')}}" />
            <x-form.input name='repeat_password' type='password' placeholder="{{__('placeholder.repeat_password')}}" />
            
            <div class="w-full">
                <x-form.button>
                  {{__('utils.sign_up')}}
                </x-form.button>
            </div>
        </form>
        <div class="w-full flex items-center justify-center mt-6">
            <p><span class="text-zinc-400">{{__('signup.have_acc')}} </span><a href="{{route('login')}}"
                    class="font-bold">{{__('signup.log_in')}} </a></p>
        </div>
    </div>
</x-auth-layout>