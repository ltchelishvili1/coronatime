<x-dashboard-layout selected='bycountry' text="{{__('dashboard.bycountry-stats')}}">
    <div class="pt-10">
        <form method="GET" action="#" class="pb-10">
            <x-form.search name="search" />
        </form>
        <div>
            <div class="bg-gray-50 flex">
                <div class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm w-1/4">
                    <a
                        href="{{ route('dashboard.bycountry', ['search' => request('search'),'country' => request('country') === 'desc' ? 'asc' : 'desc']) }}">
                        {{ __('dashboard.location') }}
                        <span class="absolute ml-2 mt-1">
                            <x-assets.arrow-up />
                            <x-assets.arrow-down />
                        </span>
                    </a>
                </div>
                <div class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm w-1/4">
                    <a
                        href="{{ route('dashboard.bycountry', ['search' => request('search'),'confirmed' => request('confirmed') === 'desc' ? 'asc' : 'desc']) }}">
                        {{ __('dashboard.new_cases') }}
                        <span class="absolute ml-2 mt-1">
                            <x-assets.arrow-up />
                            <x-assets.arrow-down />
                        </span>
                    </a>
                </div>
                <div class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm w-1/4">
                    <a
                        href="{{ route('dashboard.bycountry', ['search' => request('search'),'deaths' => request('deaths') === 'desc' ? 'asc' : 'desc']) }}">
                        {{ __('dashboard.death') }}
                        <span class="absolute ml-2 mt-1">
                            <x-assets.arrow-up />
                            <x-assets.arrow-down />
                        </span>
                    </a>
                </div>
                <div class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm w-1/4">
                    <a
                        href="{{ route('dashboard.bycountry', ['search' => request('search'),'recovered' => request('recovered') === 'desc' ? 'asc' : 'desc']) }}">
                        {{ __('dashboard.recovered') }}
                        <span class="absolute ml-2 mt-1">
                            <x-assets.arrow-up />
                            <x-assets.arrow-down />
                        </span>
                    </a>
                </div>
            </div>
            <div
                class="w-full h-[38rem] overflow-y-scroll scrollbar-thumb-gray-500 scrollbar-track-gray-300 scrollbar-thin">
                <div class="flex bg-white hover:bg-gray-50">
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">
                        {{__('dashboard.worldwide')}}
                    </div>
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">
                        {{number_format(App\Models\Statistic::sum('confirmed'))}}
                    </div>
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">
                        {{number_format(App\Models\Statistic::sum('deaths'))
                        }}
                    </div>
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">
                      
                          {{number_format(App\Models\Statistic::sum('recovered'))
                        }}
                    </div>
                </div>

                @foreach ($countries as $country)
                <div class="flex bg-white hover:bg-gray-50">
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">
                        {{ json_decode($country->country, true)[Session::get('locale', 'en')] }}
                    </div>
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">{{ number_format($country->confirmed)
                        }}
                    </div>
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">{{ number_format($country->deaths) }}
                    </div>
                    <div class="py-2 px-4 border-t border-b border-gray-100 w-1/4">{{ number_format($country->recovered)
                        }}
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-dashboard-layout>