


<div x-data="{create: false}" >
    <div x-data="{info:false}" >
        <div x-data="{edit:false}">
            <!--@include('livewire.times.times-create')-->
            <div class="p-5 h-screen bg-gray-100">
                <span class="text-xl mb-2 display:inline-block">Jogadores</span>
                <button class="mb-4 bg-blue-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" @click="create = true" wire:click="resetInputs()" id="resetSelectJogador">
                    Adicionar novo Time 
                </button>
                <div>
                    <input type="text" class="mb-4 hover:bg-gray-400 font-bold py-2 px-4 rounded-l" placeholder="Procurar pelo nome:" wire:model="searchTerm" />
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
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-35">Pais de origem</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-15">Pontuação</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left w-25">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($times as $key => $time)
                                <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100 ">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $key+1 }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->nome }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->pais_origem }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $time->pontuacao }} </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex">
                                            <button class="bg-emerald-400 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-l" wire:click.prevent="read({{ $time->id }})" @click="info = true">
                                                Visualizar 
                                            </button>
                                            <button class="ml-2 bg-blue-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" wire:click.prevent="edit({{ $time->id }})" @click="edit = true">
                                                Editar                                        
                                            </button>
                                            <button class="ml-2 bg-red-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" onclick="return confirm('Tem certeza que deseja remover {{ addslashes($time->nome) }}?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $time->id }})">
                                                Excluir                                       
                                            </button>
                                        </div>    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
                {{ $times->links() }}
            </div>
        </div>
    </div>
</div>  


