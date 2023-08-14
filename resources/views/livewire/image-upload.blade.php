<div>
    <div
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        @if (!$isUploaded)
            <div
                style='
                    width: 250px;
                    height: 250px;
                    background: url("{{$path}}") no-repeat center;
                    background-size: contain
                '></div>
        @else
            @if($file)
                <div
                    style='
                    width: 250px;
                    height: 250px;
                    background: url("{{$file->temporaryUrl()}}") no-repeat center;
                    background-size: contain
                '></div>
            @endif
        @endif
        <!-- File Input -->
        <input class="form-control my-3" type="file" wire:model="file" accept="image/*">
        @error('file') <span class="error">{{ $message }}</span> @enderror

         <input type="hidden" wire:model="image_url" name="image_url">
        <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>
    </div>
</div>
