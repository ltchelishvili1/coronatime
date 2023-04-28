<x-reset-password-layout title="{{__('messages.reset_password')}}">
    <form method="POST" action="{{route('password.update',[$token])}}">
        @csrf
        <x-form.input name="new_password" placeholder="{{__('placeholder.new_password')}}" type='password' />
        <x-form.input name="repeat_password" placeholder="{{__('placeholder.repeat_password')}}" type='password' />
        <x-form.button>
            <span class="font-extrabold text-base">{{__('messages.save_changes')}}</span>
        </x-form.button>
    </form>
</x-reset-password-layout>