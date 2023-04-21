<x-auth-layout>
    <x-auth-form-wrapper title="{{__('signup.title')}}" description="{{__('signup.description')}}">
        <form method="POST" action="{{route('register')}}">
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
        <x-form-footer-wrapper text="{{__('signup.have_acc')}}">
            <a href="{{route('login.index')}}" class="font-bold">{{__('signup.log_in')}} </a>
        </x-form-footer-wrapper>


    </x-auth-form-wrapper>
    <x-auth-lang-change-wrapper>
        <x-lang-change />

    </x-auth-lang-change-wrapper>
</x-auth-layout>