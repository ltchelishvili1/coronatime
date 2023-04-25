
<x-dashboard-layout selected='worldwide' text="{{__('dashboard.worldwide-stats')}}">
    <div class="grid pt-12 md:grid-cols-3 lg:grid-cols-3 grid-cols-2 gap-6">
        <div
            class="w-full h-64 grid justify-center items-center  bg-dark-blue/[.08]  md:col-start-1 md:col-end-2 col-start-1 col-end-3 rounded-2xl">
            <span class="h-16 flex items-center justify-center">
                <x-assets.newcases-icon />
            </span>
            <h1 class="font-medium text-xl flex items-center justify-center">{{__('dashboard.new_cases')}}</h1>
            <p class="font-black text-4xl text-dark-blue flex items-center justify-center">{{number_format($stats['confirmed'])}}</p>
        </div>
        <div class="w-full h-64 grid justify-center items-center  bg-dark-green/[.08] rounded-2xl">
            <span class="h-16 flex items-center justify-center">
                <x-assets.recovered-icon /><span class="absolute pt-2">
                    <x-assets.recovered-icon-shadow />
                </span>
            </span>
            <h1 class="font-medium text-xl flex items-center justify-center">{{__('dashboard.recovered')}}</h1>
            <p class="font-black text-4xl text-dark-green flex items-center justify-center">{{number_format($stats['recovered'])}}</p>

        </div>
        <div class="w-full h-64 grid justify-center items-center  bg-dark-yellow/[.08] rounded-2xl">
            <span class="h-16 flex items-center justify-center">
                <x-assets.death-icon />
            </span>
            <h1 class="font-medium text-xl flex items-center justify-center">{{__('dashboard.death')}}</h1>
            <p class="font-black text-4xl text-dark-yellow flex items-center justify-center">{{number_format($stats['deaths'])}}</p>

        </div>
    </div>

</x-dashboard-layout>
