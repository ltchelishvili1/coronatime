<x-reset-password-layout title='Reset Password'>
    <form method="POST" action="{{route('password.resetrequest.post')}}">
        @csrf
        <x-form.input placeholder='Enter your email' name="email" />
        <x-form.button>
    </form>
    <span class="font-extrabold text-base"> Reset Password</span>
    </x-form.button>
</x-reset-password-layout>