<div>
    @include('livewire.jogador.jogadores-create')
    @include('livewire.jogador.jogador-update')
    @include('livewire.jogador.jogador-info')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">{{session('message')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Jogadores
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJogadorModal">
                                    Adicionar novo Jogador
                                </button>
                                <input type="text" style="margin-top:10px" class="form-control" placeholder="Procurar" wire:model="searchTerm" />
                            </h3>
                        </div>
                        <div class="card-body" style="padding:0px">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Idade</th>
                                        <th>Nacionalidade</th>
                                        <!--<th>Time</th>-->
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jogadores as $jogador)
                                        <tr>
                                            <td>{{$jogador->nome}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->nacionalidade}}</td>
                                            <!--<td>{{$jogador->time}}</td>-->
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoJogadorModal" wire:click.prevent="edit({{ $jogador->id }})">Visualizar</button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updateJogadorModal" wire:click.prevent="edit({{ $jogador->id }})">Editar</button>
                                                <button type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover {{ addslashes($jogador->nome) }}?')" wire:click.prevent="delete({{ $jogador->id }})">Excluir</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $jogadores->links() }}
        </div>
    </section>
</div>