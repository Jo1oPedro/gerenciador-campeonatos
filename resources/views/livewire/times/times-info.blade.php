<!-- Modal -->
<div wire:ignore.self class="modal fade" id="infoTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" wire:model="nome" class="form-control @error('nome') is-invalid @enderror" readonly>
                @error('nome')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="pais_origem">Pais de origem</label>
                <input type="text" name="pais_origem" wire:model="pais_origem" class="form-control @error('pais_origem') is-invalid @enderror" readonly>
                @error('pais_origem')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="pontuacao">Pontuação</label>
                <input type="number" name="pontuacao" wire:model="pontuacao" class="form-control @error('pontuacao') is-invalid @enderror" readonly>
                @error('pontuacao')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="vitorias">Vitorias</label>
                <input type="number" name="vitorias" wire:model="vitorias" class="form-control @error('vitorias') is-invalid @enderror" readonly>
                @error('vitorias')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="derrotas">Derrotas</label>
                <input type="number" name="derrotas" wire:model="derrotas" class="form-control @error('derrotas') is-invalid @enderror" readonly>
                @error('derrotas')
                    {{$message}}
                @enderror
            </div>
            
            <!--<div>
                <label for="time">Time</label>
                <input type="text" name="time" wire:model="time" class="form-control @error('time') is-invalid @enderror">
                @error('time')
                    {{$message}}
                @enderror
            </div>-->   
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="resetInput()">Fechar</button>
      </div>
    </div>
  </div>
</div>