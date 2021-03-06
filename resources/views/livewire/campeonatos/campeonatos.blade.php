<div x-data="{create: false}" >
    <div x-data="{info:false}" >
        <div x-data="{edit:false}">
            @include('livewire.campeonatos.campeonato-info')
            @include('livewire.campeonatos.campeonato-create')
            @include('livewire.campeonatos.campeonato-edit')
            <div class="p-5 h-screen bg-gray-100">
                <span class="text-xl mb-2 display:inline-block">Campeonatos</span>
                <button class="mb-4 bg-blue-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" @click="create = true" wire:click="resetInputs()" id="resetSelect">
                    Adicionar novo campeonato 
                </button>
                <div>
                    <input type="text" class="mb-4 font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo nome:" wire:model="searchTerm" />
                </div>
                @if(session()->has('message'))
                    <div class="">{{session('message')}}</div>
                @elseif(session()->has('error'))
                    <div class="">{{session('error')}}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="overflow-auto rounded-lg shadow">
                    <table class="w-full cursor-pointer">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-20">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Nome</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Jogo</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Inicio</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">Encerramento</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-16">A????es</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($campeonatos as $key => $campeonato)
                                <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap font-bold">{{ $key+1 }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->nome }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->jogo }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->inicio }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $campeonato->encerramento }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex">
                                            <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="edit({{ $campeonato->id }})" @click="info = true">
                                                Visualizar 
                                            </button>
                                            <button class="ml-2 bg-blue-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" id="createEditSelect" wire:click.prevent="edit({{ $campeonato->id }})" @click="edit = true">
                                                Editar                                        
                                            </button>
                                            <button class="ml-2 bg-red-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" onclick="return confirm('Tem certeza que deseja remover {{ addslashes($campeonato->nome) }}?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $campeonato->id }})">
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
                    <div x-show="!info">
                        <div x-show="!edit">
                            {{ $campeonatos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


