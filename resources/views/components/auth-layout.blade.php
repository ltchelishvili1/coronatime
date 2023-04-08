<x-layout>
    <div class="flex flex-col md:flex-row ml-4">
        <div class="flex-1 mx-2 md:mx-28 mt-11">
            <x-svgs.coronatime />
            <div class="mt-14">
                {{$slot}}
            </div>
        </div>
        <div class="md:block hidden">
            <x-svgs.image />
        </div>
    </div>
</x-layout>
