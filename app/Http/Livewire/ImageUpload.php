<?php

namespace App\Http\Livewire;

use App\Models\File;
use Aws\Laravel\AwsFacade;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;
    public $file;
    public $image_url;
    public $path = '';
    public $folderName;
    public $isUploaded = false;

    /**
     * @param int $id $if edit send parameter id
     * @param string $folderName $set folderName
     * @return void
     */
    public function mount(int $id = 0, string $folderName = 'uploads'): void
    {
        $this->folderName = $folderName;
        if ($id != 0)
        {
            $this->image_url = $id;
            $filePath = File::find($id);
            if ($filePath)
            {
                $this->path = File::getFileFromAWS($filePath->url);
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

    public function updatedFile(): void
    {
        if ($this->image_url) {
            File::deleteFileFromAWS($this->image_url);
        }
        $this->image_url = File::uploadFileAWS($this->file, $this->folderName);
        $this->isUploaded = true;
    }
    public function render()
    {
        return view('livewire.image-upload');
    }
}
