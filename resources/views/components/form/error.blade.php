@props(['name'])

@error($name)
    <p class="text-red-500 text-sm mt-1 flex"><span class="pr-2.5"><x-assets.error-icon/></span>{{$message}}</p>
@enderror     