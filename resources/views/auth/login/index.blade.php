<x-auth-layout>
    <div class="lg:w-2/3 max-w-2/3">
        <h1 class="font-black text-2xl">{{__('login.title')}}</h1>
        <h5 class="my-4 text-zinc-400 text-xl">{{__('login.description')}}</h5>
        <form method="POST" action="{{route('login')}}">
            @csrf
            <x-form.input name='username' placeholder="{{__('placeholder.emailorusername')}}" />
            <x-form.input name='password' type='password' placeholder="{{__('placeholder.password')}}" />
            <div class="flex items-center justify-between">
                <label for="remember-me" class="inline-flex items-center mt-6 ">
                    <input id="remember-me" name="remember_me" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="1">
                    <span class="ml-2 text-black-100 font-medium text-sm">{{__('login.remember')}}</span>
                </label>
                
                <div class="inline-flex items-center mt-6 ">
                    <a href="{{route('password.resetrequest')}}" class="text-blue-600 font-medium text-sm">{{__('login.forgot_password')}}</a>
                </div>
            </div>
            <div class="w-full">
                <x-form.button>
                   {{__('utils.log_in')}}
                </x-form.button>
            </div>
        </form>
        <div class="w-full flex items-center justify-center mt-6">
            <p><span class="text-zinc-400">{{__('login.no_acc')}}</span><a href="{{route('register.index')}}"
                    class="font-bold pl-1">{{__('login.sign_up')}}</a></p>
        </div>
    </div>
    <div class="h-screen fixed flex flex-col  top-0 h-100vh ">
       <x-lang-change/> 
    </div>
</x-auth-layout>