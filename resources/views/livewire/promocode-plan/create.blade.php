<form wire:submit.prevent="submit" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Наименование плана</label>
        <input type="text" id="title" wire:model="title" class="form-control">
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <x-button type="submit" label="Отправить" primary md icon="check" />
</form>
