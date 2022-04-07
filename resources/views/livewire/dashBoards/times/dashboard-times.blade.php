<div>
    <div class="p-5 h-screen bg-gray-100" >
        <span class="text-xl mb-2 display:inline-block">Times</span>
        <div>
            <input type="text" class="mb-4 hover:bg-gray-400 font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo país de origem:" wire:model="searchTermTime" />
            <div class="inline-flex mt-2">
                <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l nt" wire:click.prevent="ordernarPor('pontuacao')">
                    Ordernar pela pontuação dos times
                </button>
            </div> 
            <div class="inline-flex mt-4">
                <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="ordernarPor('vitorias')">
                    Ordernar pelas vitorias dos times
                </button>
            </div> 
            <div class="inline-flex mt-4 mb-4">
                <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="ordernarPor('derrotas')">
                    Ordernar pelas derrota dos times 
                </button>
            </div> 
        </div>
        <div class="overflow-auto rounded-lg shadow">
            <table class="w-full cursor-pointer">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">ID</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">Nome</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">País de origem</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Pontuação</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Vitorias em campeonatos</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Derrotas em campeonatos</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($times as $key => $time)
                        <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100 ">
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $key+1 }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->nome }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->pais_origem }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->pontuacao }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->vitorias }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->derrotas }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        {{ $times->onEachSide(1)->links() }}
    </div>
</div>  


