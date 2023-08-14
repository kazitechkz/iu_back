<?php

namespace App\Http\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;
    public $file;
    public $image_url;

    protected $rules = [
        'file' => 'image|max:8092'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFile()
    {
        if ($this->image_url) {
            File::deleteFile($this->image_url);
        }
        $this->image_url = File::uploadFile($this->file, 'subjects');
    }
    public function render()
    {
        return view('livewire.image-upload');
    }
}
