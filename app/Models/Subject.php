<?php

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, CRUD, SoftDeletes, Language;

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

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_url', 'id');
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    public function subSteps(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(SubStep::class, Step::class);
    }

}
