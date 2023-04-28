<x-layout>
    <div class="flex flex-col md:flex-row ml-4">
        <div class="flex-1 mx-2 md:mx-28 mt-11">
           <a href="{{route('login.index')}}"> <x-assets.coronatime-logo /></a>
            <div class="mt-14 md:min-w-min	">
                {{$slot}}
            </div>
        </div>
        <div class="md:block hidden w-1/2">
           <img class="h-screen  ml-auto" src="{{asset('images/coronatime-background.jpg')}}" />
        </div>
    </div>
</x-layout>
