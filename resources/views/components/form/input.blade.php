@props(['name', 'placeholder', 'type' => 'text'])

<x-form.field>
    <x-form.label name={{$name}} />

    @if(!$errors->any())
    <input
        class="border border-gray-500 p-2 w-full rounded  focus:border-dark-blue focus:shadow-input-box-shadow-blue focus:outline-none active:outline-none active:shadow-input-box-shadow-blue rounded-lg px-6"
        type={{$type}} name="{{$name}}" id="{{$name}}" {{$attributes(['value'=>
    old($name), 'placeholder' => $placeholder])}}
    >
    @elseif(!$errors->has($name))
    <input
        class="border border-green-500 p-2 w-full rounded  focus:border-dark-blue focus:shadow-input-box-shadow-blue focus:outline-none  active:outline-none active:shadow-input-box-shadow-blue rounded-lg  px-6"
        type={{$type}} name="{{$name}}" id="{{$name}}" {{$attributes(['value'=>
    old($name), 'placeholder' => $placeholder])}}
    >
    <span class="absolute transform translate-y-1/2 -translate-x-12 text-gray-500">
        <x-assets.success-icon />
    </span>
    @else
    <input
        class="border border-red-500 p-2 w-full rounded  focus:border-dark-blue focus:outline-none focus:shadow-input-box-shadow-blue rounded-lg  active:outline-none active:shadow-input-box-shadow-blue rounded-lg px-6"
        type={{$type}} name="{{$name}}" id="{{$name}}" {{$attributes(['value'=>
    old($name), 'placeholder' => $placeholder])}}
    >
    @endif

    <x-form.error name={{$name}} />
</x-form.field>