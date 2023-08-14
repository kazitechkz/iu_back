<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;
    public $file;
    public $title_kk;
    public $title_ru;
    public $title_en;

    protected $rules = [
        'title_kk' => 'required',
        'title_ru' => 'required',
        'title_en' => 'required',
        'file' => 'image'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function updatedFile()
    {
        $this->validate([
            'file' => 'image|max:8092', // 8MB Max
        ]);
    }

    public function save()
    {
        $this->validate();
        $fileId = File::uploadFile($this->file, 'subjects');
        Subject::create([
           'title_kk' => $this->title_kk,
           'title_ru' => $this->title_ru,
           'title_en' => $this->title_en,
           'file_id' => $fileId,
        ]);
        $this->redirect(route('subject.index'));
    }
    public function render()
    {
        return view('livewire.file-upload');
    }
}
