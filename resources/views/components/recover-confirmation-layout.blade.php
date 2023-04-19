<x-layout>
    <div class="grid pt-40">
        <div class="lg:m-auto md:m-auto">
            <x-assets.landing-page-image />
        </div>
        <div class="grid justify-center  pt-12 ">
            <h1 class="font-black text-2xl flex justify-center ">{{$mainText}}</h1>
            <p class="font-normal text-lg pt-4">{{$description}}</p>
            <x-form.button>{{$buttonText}}</x-form.button>
        </div>
    </div>
</x-layout>