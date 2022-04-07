<div 
    x-show.transition.duration.500ms="jogadores"
    class="fixed inset-0 bg-white bg-opacity-75 px-4 md:px-0"
    >
    <div class="bg-white shadow-2xl rounded-lg border-2 border-gray-400 p-6">
        <div class="flex justify-between mb-4">
            <h3 class="font-bold text-2xl font-bold">Informações dos jogadores do time</h3>
            <button @click="jogadores = false">
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
            <span class="text-xl display:inline-block">Jogadores do time</span>
            <div>
                <input type="text" class="mb-4 mt-2 w-full font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo nome:" wire:model="searchTermJogador" />
            </div>
            <div class="overflow-auto rounded-lg shadow">
                <table class="w-full cursor-pointer">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">ID</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Nacionalidade</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Vitorias</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Derrotas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($jogadores as $key => $jogador)
                            <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100 ">
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">{{ $key+1 }} </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->nome }} </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->nacionalidade }} </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->vitorias }} </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->derrotas }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                {{ $jogadores->onEachSide(1)->links() }}
        </div>
    </div>
</div>
