<?php

namespace App\Models;

use App\Traits\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, FileUpload;

    protected $fillable = ['title_kk', 'title_ru', 'title_en', 'file_id'];
}
