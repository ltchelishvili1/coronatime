<x-messages-layout>
    <p class="mt-4">{{__('messages.reset-password-changed')}}</p>
    <div class="mt-24 flex items-center justify-center">
        <a href="{{route('login')}}"
            class="flex items-center justify-center bg-green-500 w-full text-white uppercase font-black text-base py-2 px-10 rounded hover:bg-green-600">{{__('messages.sign_in')}}</a>
    </div>
</x-messages-layout>