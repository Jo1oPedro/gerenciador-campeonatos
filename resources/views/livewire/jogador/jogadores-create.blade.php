<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addJogadorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar novo jogador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" wire:model="nome">
                <div class="invalid-feedback">
                    @error('nome')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div>
                <label for="idade">Idade</label>
                <input type="number" name="idade" class="form-control @error('idade') is-invalid @enderror" wire:model="idade">
                <div class="invalid-feedback">
                    @error('idade')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div>
                <label for="nacionalidade">Nacionalidade</label>
                <input type="text" name="nacionalidade" class="form-control @error('nacionalidade') is-invalid @enderror" wire:model="nacionalidade">
                <div class="invalid-feedback">
                    @error('nacionalidade')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <!--<div>
                <label for="time">Time</label>
                <input type="text" name="time" class="form-control @error('time') is-invalid @enderror" wire:model="time">
                <div class="invalid-feedback">
                    @error('time')
                        {{$message}}
                    @enderror
                </div>
            </div>-->   
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" wire:click.prevent="store()">Adicionar jogador</button>
      </div>
    </div>
  </div>
</div>