<div x-data="{times: false}" >
@include('livewire.dashBoards.campeonatos.dashboard-info-times')
    <div class="p-5 h-screen bg-gray-100" >
        <span class="text-xl display:inline-block font-bold">Campeonatos</span>
        <div>
            <input type="text" class="mb-4 mt-2 hover:bg-gray-400 font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo nome:" wire:model="searchTermCampeonato" />
        </div>
        <div class="overflow-auto rounded-lg shadow">
            <table class="w-full cursor-pointer">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">ID</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Nome</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">Jogo</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">Inicio</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">Encerramento</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">Informação dos times no campeonato</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($campeonatos as $key => $campeonato)
                        <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100 ">
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">{{ $key+1 }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->nome }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->jogo }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->inicio }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->encerramento }} </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <div class="inline-flex">
                                    <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="getTimes({{ $campeonato->id }})" @click="times = true">
                                        Visualizar informação dos times no campeonato
                                    </button>
                                </div>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        <div x-show="!times">
            {{ $campeonatos->onEachSide(1)->links() }}
        </div>
    </div>
</div>  


