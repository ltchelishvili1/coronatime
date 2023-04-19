<nav class="flex justify-between items-center h-20 md:h-90">
    <div class="grid grid-cols-2 items-center flex-grow">
        <div class="flex items-center">
            <x-assets.coronatime-logo class="h-20 md:h-28 mr-4" />
        </div>
        <div class="flex items-center justify-end">
            <div class="ml-auto  md:block">
                <div x-data="{show: false}" @click.away="show=false">
                    <button class="mr-12 sm:mr-10 text-base flex items-center gap-1" @click="show = !show">
                        {{app()->getLocale()=='en'?'English':'ქართული'}}
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
            </div>
            <div class="lg:flex md:flex lg:relative md:relative fixed md:top-0 top-16 md:block hidden"
                id="usernameAndLogout">
                <div class="grid grid-cols-2 divide-x">
                    <div>
                        <h1 class="font-bold text-base mr-4">{{ auth()->user()->username }}
                        </h1>
                    </div>
                    <div>
                        <a href="{{route('logout')}}" class="ml-4">{{__('dashboard.log_out')}}</a>
                    </div>
                </div>
            </div>
            <div class="ml-auto md:hidden">
                <button id="toggleBtn" class="focus:outline-none">
                    <x-assets.toggle-icon />
                </button>
            </div>
        </div>
    </div>
</nav>
<div class="mt-14">
    <p class="text-2xl font-extrabold">{{$text}}</p>
    <div class="mt-10 flex">
        <div class="block relative">
            <a href="{{route('dashboard')}}"
                class="{{ $selected === 'worldwide' ? 'font-bold' : '' }} text-base">{{__('dashboard.worldwide')}}</a>
            @if($selected === 'worldwide')
            <span class="absolute bg-black top-9 left-0 right-0 h-0.5"></span>
            @endif
        </div>

        <div class="block relative ml-16">
            <a href="{{route('dashboard.bycountry')}}"
                class="{{ $selected === 'bycountry' ? 'font-bold' : '' }} text-base">{{__('dashboard.bycountry')}}</a>
            @if($selected === 'bycountry')
            <span class="absolute bg-black top-9 left-0 right-0 h-0.5"></span>
            @endif
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById("toggleBtn");
    const usernameAndLogout = document.getElementById("usernameAndLogout");
    toggleBtn.addEventListener("click", () => {
        usernameAndLogout.classList.toggle("hidden");
    });
</script>