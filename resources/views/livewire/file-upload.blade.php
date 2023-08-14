<div>
    <div
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <form wire:submit.prevent="save">
            @csrf
            <div class="my-2">
                <x-input wire:model="title_kk" label="Наименование на каз" placeholder="Наименование на каз" />
            </div>
            <div class="my-2">
                <x-input wire:model="title_ru" label="Наименование на рус" placeholder="Наименование на рус" />
            </div>
            <div class="my-2">
                <x-input wire:model="title_en" label="Наименование на анг" placeholder="Наименование на анг" />
            </div>

            @if ($file)
                <div style='width: 250px; height: 250px; background: url("{{$file->temporaryUrl()}}") no-repeat center; background-size: contain'></div>
            @endif
            <!-- File Input -->
            <input class="form-control my-3" type="file" wire:model="file" accept="image/*">
            @error('file') <span class="error">{{ $message }}</span> @enderror
            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>

            <div class="my-3">
                <button type="submit" class="btn btn-success bg-success">Соханить</button>
            </div>
        </form>


    </div>
</div>
