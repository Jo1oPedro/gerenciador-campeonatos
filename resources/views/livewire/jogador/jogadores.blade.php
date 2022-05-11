<div x-data="{create: false}" >
    <div x-data="{info:false}" >
        <div x-data="{edit:false}">
            @include('livewire.jogador.jogadores-create')
            @include('livewire.jogador.jogador-update')
            @include('livewire.jogador.jogador-info')
            <div class="p-5 h-screen bg-gray-100">
                <span class="text-xl mb-2 display:inline-block font-bold">Jogadores</span>
                <button class="mb-4 bg-blue-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" @click="create = true" wire:click="resetInputs()" id="resetSelectJogador">
                    Adicionar novo jogador 
                </button>
                <div>
                    <input type="text" class="mb-4 font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo nome:" wire:model="searchTerm" />
                </div>
                @if(session()->has('message'))
                    <div class="">{{session('message')}}</div>
                @elseif(session()->has('error'))
                    <div class="">{{session('error')}}</div>
                @endif
                <div class="overflow-auto rounded-lg shadow">
                    <table class="w-full cursor-pointer">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-35">Idade</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Nacionalidade</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Time</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($jogadores as $key => $jogador)
                                <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100 ">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">{{ $key+1 }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->nome }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->idade }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $jogador->nacionalidade }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $times[$key] }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex">
                                            <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="read({{ $jogador->id }})" @click="info = true">
                                                Visualizar 
                                            </button>
                                            <button class="ml-2 bg-blue-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" wire:click.prevent="edit({{ $jogador->id }})" @click="edit = true">
                                                Editar                                        
                                            </button>
                                            <button class="ml-2 bg-red-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" onclick="return confirm('Tem certeza que deseja remover {{ addslashes($jogador->nome) }}?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $jogador->id }})">
                                                Excluir                                       
                                            </button>
                                        </div>    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div x-show="!create">
                    <div x-show="!edit">
                        <div x-show="!info">
                            {{ $jogadores->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


