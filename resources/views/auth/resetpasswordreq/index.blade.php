<x-reset-password-layout title="{{__('forgot-password.reset_password')}}">
    <form method="POST" action="{{route('password.resetrequest.post')}}">
        @csrf
        <x-form.input placeholder="{{__('placeholder.email')}}" name="email" />
        <x-form.button>
    </form>
    <span class="font-extrabold text-base">{{__('forgot-password.reset_password')}}</span>
    </x-form.button>
</x-reset-password-layout>