<?php

namespace App\Models;

use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, CRUD;

    protected $fillable = ['title_kk', 'title_ru', 'title_en', 'file_id'];
}
