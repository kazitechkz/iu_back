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

    public function questions_kk()
    {
        return $this->questions()->where('locale_id', 1);
    }
    public function questions_ru()
    {
        return $this->questions()->where('locale_id', 2);
    }
    public function questions_bobo_kk()
    {
        return $this->questions_kk()->where('group_id', 1);
    }
    public function questions_bobo_ru()
    {
        return $this->questions_ru()->where('group_id', 1);
    }
    public function questions_grant_kk()
    {
        return $this->questions_kk()->where('group_id', 4);
    }
    public function questions_grant_ru()
    {
        return $this->questions_ru()->where('group_id', 4);
    }
    public function questions_shin_kk()
    {
        return $this->questions_kk()->where('group_id', 6);
    }
    public function questions_shin_ru()
    {
        return $this->questions_ru()->where('group_id', 6);
    }
    public function questions_orbital_kk()
    {
        return $this->questions_kk()->where('group_id', 5);
    }
    public function questions_orbital_ru()
    {
        return $this->questions_ru()->where('group_id', 5);
    }
    public function questions_istudy_kk()
    {
        return $this->questions_kk()->where('group_id', 7);
    }
    public function questions_istudy_ru()
    {
        return $this->questions_ru()->where('group_id', 7);
    }
    public function questions_other_kk()
    {
        return $this->questions_kk()->whereNotIn('group_id', [1,4,5,6,7]);
    }
    public function questions_other_ru()
    {
        return $this->questions_ru()->whereNotIn('group_id', [1,4,5,6,7]);
    }
    public function questions_single_type_kk()
    {
        return $this->questions_kk()->where('type_id',1);
    }
    public function questions_single_type_ru()
    {
        return $this->questions_ru()->where('type_id',1);
    }
    public function questions_context_type_kk()
    {
        return $this->questions_kk()->where('type_id',2);
    }
    public function questions_context_type_ru()
    {
        return $this->questions_ru()->where('type_id',2);
    }
    public function questions_multi_type_kk()
    {
        return $this->questions_kk()->where('type_id',2);
    }
    public function questions_multi_type_ru()
    {
        return $this->questions_ru()->where('type_id',2);
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
