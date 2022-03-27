<div class="container" style="margin-top: 25px">
    @include('livewire.jogador.jogadores-create')
    @include('livewire.jogador.jogador-update')
    @include('livewire.jogador.jogador-info')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">{{session('message')}}</div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Jogadores
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJogadorModal" wire:click.prevent="resetInput()">
                                    Adicionar novo jogador
                                </button>
                                <input type="text" style="margin-top:20px" class="form-control" placeholder="Procurar" wire:model="searchTerm" />
                            </h3>
                        </div>
                        <div class="card-body" style="padding:25px">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="padding-left:135px;">Nome</th>
                                        <th>Idade</th>
                                        <th>Nacionalidade</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jogadores as $jogador)
                                        <tr>
                                            <td style="padding-left:135px;">{{$jogador->nome}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->nacionalidade}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#infoJogadorModal" wire:click.prevent="edit({{ $jogador->id }})">Visualizar</button>
                                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#updateJogadorModal" wire:click.prevent="edit({{ $jogador->id }})">Editar</button>
                                                <button type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover {{ addslashes($jogador->nome) }}?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $jogador->id }})">Excluir</button>
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