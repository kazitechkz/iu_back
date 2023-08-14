<?php

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, CRUD;

    protected $fillable = [
        'title_kk',
        'title_ru',
        'enable',
        'is_compulsory',
        'max_questions_quantity',
        'image_url'
    ];
}
