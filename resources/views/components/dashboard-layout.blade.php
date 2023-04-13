<x-layout>
    <div class="lg:px-28 md:px-28 px-4">
        <x-navbar :selected="$selected" :text="$text"/>
        {{$slot}}
    </div>
</x-layout>