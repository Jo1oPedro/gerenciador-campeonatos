

<div 
    x-show.transition.duration.500ms="info"
    class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center px-4 md:px-0"
    >
    <div class="flex flex-col max-w-lg bg-white shadow-2xl rounded-lg border-2 border-gray-400 p-6" @click.away="info = false">
        <div class="flex justify-between mb-4">
            <h3 class="font-bold text-2xl">Visualizar time</h3>
            <button @click="info = false">
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
        <div class="">
            <form class="w-full max-w-sm">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-nome">
                        Nome
                    </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="view-nome" type="text" wire:model="nome" readonly>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-paisOrigem">
                        	Pais de origem
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="view-paisOrigem" type="text" wire:model="paisOrigem" readonly>
                    </div>
                </div>
				<div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-pontuacao">
                        	Pontuação
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="view-pontuacao" type="number" wire:model="pontuacao" readonly>
                    </div>
                </div>
				<div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-paisOrigem">
							Vitorias
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="view-vitorias" type="number" wire:model="vitorias" readonly>
                    </div>
                </div>
				<div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-paisOrigem">
							Derrotas
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="view-derrotas" type="number" wire:model="derrotas" readonly>
                    </div>
                </div>
                <div class="inline-block relative w-full">
                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-jogadores">
                        Jogadores no time
                    </label>
                    <select class="mt-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="view-jogadores">
                        <option disabled selected>Jogadores:</option> 
                        @if(is_object($jogadoresNoTime))   
                            @foreach($jogadoresNoTime as $key => $jogador)
                                <option>Jogador {{ $key+1 }}: {{ $jogador->nome }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="inline-block relative w-full">
                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="view-jogadores">
                        Campeonatos do time
                    </label>
                    <select class="mt-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="view-jogadores">
                        <option disabled selected>Campeonatos:</option> 
                        @if(is_object($campeonatosDoTime))   
                            @foreach($campeonatosDoTime as $key => $campeonato)
                                <option>Campeonato {{ $key+1 }}: {{ $campeonato->nome }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
