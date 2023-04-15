<x-reset-password-layout title='Reset Password'>
    <form method="POST" action="{{route('password.update',[$token])}}">
        @csrf
        <x-form.input name="new password" placeholder='Enter new password' type='password' />
        <x-form.input name="repeat password" placeholder='Repeat Password' type='password' />
        <x-form.button>
            <span class="font-extrabold text-base">Save Changes</span>
        </x-form.button>
    </form>
</x-reset-password-layout>