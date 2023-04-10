<x-form.field>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x-svgs.search/>
        </div>
        <input name="{{$name}}" id="{{$name}}" type="search" placeholder="search by country" {{$attributes(['value'=>
        old($name)])}}
        class="block pl-9 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm
        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        >
    </div>

    <x-form.error name={{$name}} />
</x-form.field>