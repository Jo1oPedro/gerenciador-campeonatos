<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateJogadorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar jogador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <input type="hidden" name="id" wire:model="jogadorId">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="idade">Idade</label>
                <input type="number" name="idade" wire:model="idade" class="form-control @error('idade') is-invalid @enderror">
                @error('idade')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="nacionalidade">Nacionalidade</label>
                <input type="text" name="nacionalidade" wire:model="nacionalidade" class="form-control @error('nacionalidade') is-invalid @enderror">
                @error('nacionalidade')
                    {{$message}}
                @enderror
            </div>
            <div>
                <label for="time">Time</label>
                <input type="text" name="time" wire:model="time" class="form-control @error('time') is-invalid @enderror">
                @error('time')
                    {{$message}}
                @enderror
            </div>   
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" wire:click.prevent="update()">Adicionar jogador</button>
      </div>
    </div>
  </div>
</div>