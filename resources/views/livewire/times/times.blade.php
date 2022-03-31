<div class="container" style="margin-top: 25px">
    @include('livewire.times.times-create')
    @include('livewire.times.times-update')
    @include('livewire.times.times-info')
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
                                Times
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTimeModal" wire:click.prevent="resetInput()">
                                    Adicionar novo Time
                                </button>
                                <input type="text" style="margin-top:20px" class="form-control" placeholder="Procurar pelo nome" wire:model="searchTerm" />
                            </h3>
                        </div>
                        <div class="card-body table-responsive" style="padding:25px">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="padding-left:135px;">Nome</th>
                                        <th>Pais de Origem</th>
                                        <th>Pontuação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($times as $time)
                                        <tr>
                                            <td style="padding-left:135px;">{{$time->nome}}</td>
                                            <td>{{$time->pais_origem}}</td>
                                            <td>{{$time->pontuacao}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#infoTimeModal" wire:click.prevent="edit({{ $time->id }})">Visualizar</button>
                                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#updateTimeModal" wire:click.prevent="edit({{ $time->id }})">Editar</button>
                                                <button type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover {{ addslashes($time->nome) }}?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $time->id }})">Excluir</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $times->links() }}
        </div>
    </section>
</div>