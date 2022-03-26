<div>
    @include('livewire.jogador.jogadores-create')
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
                            </h3>
                        </div>
                        <div class="card-body" style="padding:0px">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Idade</th>
                                        <th>Nacionalidade</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jogadores as $jogador)
                                        <tr>
                                            <td>{{$jogador->name}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->nacionalidade}}</td>
                                            <td>{{$jogador->time}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $pagination->links() }}
        </div>
    </section>
</div>
