<div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Students</h3>
                        </div>
                        <div class="card-body">
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
