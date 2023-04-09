<x-layout>
    <div class="lg:px-28 md:px-28 px-4">
        <x-navbar selected='worldwide' />
        <div class="grid pt-12 md:grid-cols-3 lg:grid-cols-3 grid-cols-2 gap-6">
            <div class="w-full h-64 grid justify-center items-center shadow-cardboxshadow bg-customblue/[.08]  md:col-start-1 md:col-end-2 col-start-1 col-end-3 rounded-2xl">
              <span class="h-16 flex items-center justify-center"> <x-svgs.newcases /></span> 
                <h1 class="font-medium text-xl flex items-center justify-center">New Cases</h1>
                <p class="font-black text-4xl text-customblue ">715,523</p>
            </div>
            <div class="w-full h-64 grid justify-center items-center shadow-cardboxshadow bg-customgreen/[.08] rounded-2xl">
                <span class="h-16 flex items-center justify-center"> <x-svgs.recovered /><span class="absolute pt-2"> <x-svgs.recovered-shadow/></span></span> 
                <h1 class="font-medium text-xl flex items-center justify-center">Recovered</h1>
                <p class="font-black text-4xl text-customgreen ">715,523</p>

            </div>
            <div class="w-full h-64 grid justify-center items-center shadow-cardboxshadow bg-customyellow/[.08] rounded-2xl">
                <span class="h-16 flex items-center justify-center"> <x-svgs.death /></span> 
                <h1 class="font-medium text-xl flex items-center justify-center">Death</h1>
                <p class="font-black text-4xl text-customyellow ">715,523</p>

            </div>
          </div>
          
    </div>
</x-layout>