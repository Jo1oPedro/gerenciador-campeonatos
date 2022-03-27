<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar novo Time</h5>
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
                <label for="pais_origem">Pais de origem</label>
                <input type="text" name="pais_origem" class="form-control @error('pais_origem') is-invalid @enderror" wire:model="pais_origem">
                <div class="invalid-feedback">
                    @error('pais_origem')
                        {{$message}}
                    @enderror
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="resetInput()">Fechar</button>
        <button type="button" class="btn btn-primary" wire:click.prevent="store()">Adicionar Time</button>
      </div>
    </div>
  </div>
</div>