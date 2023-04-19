<x-dashboard-layout selected='bycountry' text="{{__('dashboard.bycountry-stats')}}">
    <div class="pt-10">
        <form class="pb-10">
            @csrf

            <x-form.search name="search" />
        </form>
        <table class="w-full absolute border-collapse md:relative lg:relative left-0">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm whitespace-nowrap">
                        {{__('dashboard.location')}}</th>
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm whitespace-nowrap">
                        {{__('dashboard.new_cases')}}</th>
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm">{{__('dashboard.death')}}</th>
                    <th class="py-2 px-4 border-b border-gray-100 text-left font-semibold text-sm">{{__('dashboard.recovered')}}</th>
                </tr>

            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-t border-b border-gray-100">1</td>
                    <td class="py-2 px-4 border-t border-b border-gray-100">2</td>
                    <td class="py-2 px-4 border-t border-b border-gray-100">3</td>
                    <td class="py-2 px-4 border-t border-b border-gray-100">4</td>
                </tr>
            </tbody>
        </table>


    </div>
</x-dashboard-layout>