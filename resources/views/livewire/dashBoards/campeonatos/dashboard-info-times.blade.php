<div 
    x-show.transition.duration.500ms="times"
    class="fixed inset-0 bg-white bg-opacity-75 px-4 md:px-0"
    >
    <div class="bg-white shadow-2xl rounded-lg border-2 border-gray-400 p-6" @click.away="times = false">
        <div class="flex justify-between mb-4">
            <h3 class="font-bold text-2xl">Informações dos times</h3>
            <button @click="times = false">
                <svg version="1.1" id="Capa_1" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717
                                L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859
                                c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287
                                l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285
                                L284.286,256.002z"/>
                        </g>
                    </g>
                </svg>
            </button>
        </div>
        <div class="p-5 h-screen bg-gray-100">
                <span class="text-xl mb-2 display:inline-block">Times do campeonato </span>
                <div>
                    <input type="text" class="mb-4 hover:bg-gray-400 w-full font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo nome:" wire:model="searchTermTime" />
                </div>
                <div class="overflow-auto rounded-lg shadow">
                    <table class="w-full cursor-pointer">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Pais de origem</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Pontuação</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Vitorias</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Derrotas</th>
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
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex">
                                            <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="" @click="times = true">
                                                Visualizar informação dos times no campeonato
                                            </button>
                                        </div>    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @php
                    if(is_object($times)) {
                        $times->onEachSide(1)->links();
                    };
                @endphp
            </div>
    </div>
</div>

        

