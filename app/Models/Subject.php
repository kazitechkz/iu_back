<?php

namespace App\Models;

use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Laravel\Prompts\select;

class Subject extends Model
{
    use HasFactory, CRUD, SoftDeletes;

    protected $fillable = [
        'title_kk',
        'title_ru',
        'enable',
        'is_compulsory',
        'max_questions_quantity',
        'image_url'
    ];

    public static function initialData($request)
    {
        $data = $request->all();
        if ($request['is_compulsory']) {
            $data['is_compulsory'] = 1;
        } else {
            $data['is_compulsory'] = 0;
        }
        return $data;
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class, 'image_url', 'id');
    }

}
