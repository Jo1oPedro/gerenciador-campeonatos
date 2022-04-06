<div 
    x-show.transition.duration.500ms="edit"
    class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center px-4 md:px-0"
    >
    <div class="flex flex-col max-w-lg bg-white shadow-2xl rounded-lg border-2 border-gray-400 p-6" @click.away="edit = false">
        <div class="flex justify-between mb-4">
            <h3 class="font-bold text-2xl">Editar time</h3>
            <button @click="edit = false">
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
                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-nome">
                        Nome
                    </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class=" appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="edit-nome" type="text" wire:model.defer="nome">
                        <div class="invalid-feedback">
                            @error('nome')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-paisOrigem">
                        	Pais de origem
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class=" appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="edit-paisOrigem" type="text" wire:model.defer="paisOrigem">
                        <div class="invalid-feedback">
                            @error('paisOrigem')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-pontuacao">
							Pontuação
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class=" appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="edit-pontuacao" type="number" wire:model.defer="pontuacao">
                        <div class="invalid-feedback">
                            @error('pontuacao')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-vitorias">
                            Vitorias
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="edit-vitorias" type="number" wire:model.defer="vitorias">
                        <div class="invalid-feedback">
                            @error('vitorias')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-derrotas">
                          Derrotas
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class=" appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="edit-derrotas" type="number" wire:model.defer="derrotas">
                        <div class="invalid-feedback">
                            @error('derrotas')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-role"
                        >Selecione os jogadores do time
					</label>
                    <div class="relative flex w-full"> <!--wire:ignore permite com que seja possivel manter os valores do select(options) sendo exibidos ao mesmo tempo que eles são atualizados dentro do component-->
                        <select
							multiple
							placeholder="Editar times..."
							autocomplete="off"
							class="block w-full rounded-sm cursor-pointer focus:outline-none"
							wire:model.defer="jogadoresNoTime"
                        >
							@if(is_object($jogadoresNoTime) && ((count($jogadoresNoTime) > 0) || (count($jogadoresSemTime) > 0)) )
								@foreach ($jogadoresNoTime as $jogador)
									<option value="{{ $jogador->id }}" selected style="background-color:green;color:blue">Jogador já selecionado: {{ $jogador->nome }}</option>
								@endforeach
								@foreach($jogadoresSemTime as $jogador)
									<option value="{{ $jogador->id }}">Jogador não selecionado: {{ $jogador->nome }}</option>
								@endforeach
							@endif
                        <!--<option selected>Macaco triste</option>
                        <option selected>Monkey</option>
                        <option selected>Macaco muito triste</option>-->
                        </select>
                    </div>
                </div>
				<div class="mt-4">
                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="edit-role"
                        >Selecione os campeonatos do time
					</label>
                    <div class="relative flex w-full"> <!--wire:ignore permite com que seja possivel manter os valores do select(options) sendo exibidos ao mesmo tempo que eles são atualizados dentro do component-->
                        <select
							multiple
							placeholder="Editar times..."
							autocomplete="off"
							class="block w-full rounded-sm cursor-pointer focus:outline-none"
							wire:model.defer="campeonatosDoTime"
                        >
							@if(is_object($campeonatosDoTime) && ((count($campeonatosDoTime) > 0) || (count($campeonatosSemEsseTime) > 0)) )
								@foreach ($campeonatosDoTime as $campeonato)
									<option value="{{ $campeonato->id }}" selected style="background-color:green;color:blue">Campeonato já selecionado: {{ $campeonato->nome }}</option>
								@endforeach
								@foreach($campeonatosSemEsseTime as $campeonato)
									<option value="{{ $campeonato->id }}">Campeonato não selecionado: {{ $campeonato->nome }}</option>
								@endforeach
							@endif
                        <!--<option selected>Macaco triste</option>
                        <option selected>Monkey</option>
                        <option selected>Macaco muito triste</option>-->
                        </select>
                    </div>
                </div>
                <div class="md:flex md:items-center mt-4">
                    <!--<div class="md:w-1/3"></div>-->
                    <div class="">
                    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button" wire:click.prevent="update()" @click="edit = false">
                        Editar
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

