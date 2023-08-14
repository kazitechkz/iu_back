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
    public $path = '';
    public $isUploaded = false;

    /**
     * @param $id $if edit send parameter id
     * @return void
     */
    public function mount(int $id = 0): void
    {
        if ($id != 0)
        {
            $this->image_url = $id;
            $filePath = File::find($id);
            if ($filePath)
            {
                $this->path = $filePath->url;
            }

        }
    }

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
        $this->isUploaded = true;
    }
    public function render()
    {
        return view('livewire.image-upload');
    }
}
