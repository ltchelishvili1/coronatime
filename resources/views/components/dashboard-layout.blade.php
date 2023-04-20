<x-layout>
    <div class="lg:px-28 md:px-28 px-4">
        <x-header :selected="$selected" :text="$text"/>
       <div> {{$slot}}</div>
    </div>
</x-layout>