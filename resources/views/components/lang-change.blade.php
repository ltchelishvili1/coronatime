<div x-data="{show: false}" @click.away="show=false">
    <button class="r mr-12 sm:mr-10 text-base flex items-center gap-1" @click="show = !show">
        {{app()->getLocale()=='en'?'English':'ქართული'}}
        <span class="ml-2">
            <x-assets.language-arrow />
        </span>
    </button>
    <div x-show="show" class="absolute bg-neutral-200 rounded-sm" style="display: none">
        <a class="block py-1 pl-2 hover:bg-neutral-300 pr-1  {{'ka' == App::getLocale() ? 'bg-blue-600 text-white hover:bg-blue-600':'bg-transparent '}}"
            href="{{ route('set-language', 'ka') }}">
            {{__('dashboard.georgian')}}</a>
        <a class="block py-1 pl-2 hover:bg-neutral-300 pr-1  {{'en' == App::getLocale() ? 'bg-blue-600 text-white hover:bg-blue-600':'bg-transparent '}}"
            href="{{ route('set-language', 'en') }}">
            {{__('dashboard.english')}}</a>
    </div>
</div>