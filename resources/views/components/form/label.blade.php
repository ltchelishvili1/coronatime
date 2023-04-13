@props(['name'])


<label class="block mb-2 font-bold text-base text-gray-700" for="{{$name}}">
    {{ucwords($name)}}
</label>