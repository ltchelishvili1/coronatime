<x-dashboard-layout selected='bycountry' text="{{__('dashboard.bycountry-stats')}}">
    <div class="pt-10">
        <form method="GET" action="#" class="pb-10">
            <x-form.search name="search" />
        </form>
        <table class="w-full absolute border-collapse md:relative lg:relative left-0 ">
            <thead>
                <tr class="bg-gray-50 ">
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm whitespace-nowrap">
                        <a
                            href="{{route('dashboard.bycountry', ['search' => request('search'),'country' => request('country') === 'desc' ? 'asc' : 'desc'])}}"
                            >
                            {{__('dashboard.location')}}
                            <span class="absolute ml-2 mt-1">
                                <x-assets.arrow-up />
                                <x-assets.arrow-down />
                            </span>
                        </a>
                    </th>
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm whitespace-nowrap">
                        <a 
                        href="{{route('dashboard.bycountry', ['search' => request('search'),'confirmed' => request('confirmed') === 'desc' ? 'asc' : 'desc'])}}"
                        > {{__('dashboard.new_cases')}}
                            <span class="absolute ml-2 mt-1">
                                <x-assets.arrow-up />
                                <x-assets.arrow-down />
                            </span>
                        </a>
                    </th>
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm">
                        <a 
                        href="{{route('dashboard.bycountry', ['search' => request('search'),'deaths' => request('deaths') === 'desc' ? 'asc' : 'desc'])}}"
                        > {{__('dashboard.death')}}
                            <span class="absolute ml-2 mt-1">
                                <x-assets.arrow-up />
                                <x-assets.arrow-down />
                            </span>
                        </a>
                    </th>
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm">
                        <a 
                        href="{{route('dashboard.bycountry', ['search' => request('search'),'recovered' => request('recovered') === 'desc' ? 'asc' : 'desc'])}}"
                        >
                            {{__('dashboard.recovered')}}
                            <span class="absolute ml-2 mt-1">
                                <x-assets.arrow-up />
                                <x-assets.arrow-down />
                            </span>
                        </a>
                    </th>
                </tr>
            </thead>
            @foreach ($countries as $country)
            <tbody>
                <tr class="hover:bg-gray-50 flex-column">
                    <td class="py-2 px-4 border-t border-b border-gray-100 w-1/4">
                        {{ json_decode($country->country, true)[Session::get('locale')] }}
                    </td>
                    <td class="py-2 px-4 border-t border-b border-gray-100 w-1/4">{{number_format($country->confirmed)}}
                    </td>
                    <td class="py-2 px-4 border-t border-b border-gray-100 w-1/4">{{number_format($country->deaths)}}
                    </td>
                    <td class="py-2 px-4 border-t border-b border-gray-100 w-1/4">{{number_format($country->recovered)}}
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>



    </div>
</x-dashboard-layout>