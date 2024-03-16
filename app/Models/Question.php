<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Coders\Model\Relations\HasOne;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * Class Question
 *
 * @property int $id
 * @property string|null $context
 * @property string $text
 * @property string $answer_a
 * @property string $answer_b
 * @property string $answer_c
 * @property string $answer_d
 * @property string $answer_e
 * @property string|null $answer_f
 * @property string|null $answer_g
 * @property string|null $answer_h
 * @property string $correct_answers
 * @property string|null $prompt
 * @property string|null $prompt_image
 * @property int|null $locale_id
 * @property string|null $explanation
 * @property string|null $explanation_image
 * @property int|null $subject_id
 * @property int $type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Locale|null $locale
 * @property Subject|null $subject
 * @property QuestionType $question_type
 *
 * @package App\Models
 */
class Question extends Model implements Searchable
{
	use SoftDeletes, CRUD;
	protected $table = 'questions';

	protected $casts = [
		'locale_id' => 'int',
		'subject_id' => 'int',
		'type_id' => 'int'
	];

	protected $fillable = [
		'context_id',
		'text',
		'answer_a',
		'answer_b',
		'answer_c',
		'answer_d',
		'answer_e',
		'answer_f',
		'answer_g',
		'answer_h',
		'correct_answers',
		'prompt',
		'prompt_image',
		'locale_id',
		'explanation',
		'explanation_image',
		'subject_id',
		'type_id',
        'group_id',
        'sub_category_id'
	];

	public function locale(): BelongsTo
    {
		return $this->belongsTo(Locale::class);
	}

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

	public function subject(): BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

	public function type(): BelongsTo
    {
		return $this->belongsTo(QuestionType::class, 'type_id');
	}

    public function context():BelongsTo{
        return $this->belongsTo(SubjectContext::class, "context_id");

    }

    public function getSearchResult(): SearchResult
    {

        return new SearchResult(
            $this,
            $this->id,
            $this->text
        );
    }

    public function sub_step_test(): BelongsTo
    {
        return $this->belongsTo(SubStepTest::class, 'id', 'question_id');
    }

    public function attempt_questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AttemptQuestion::class, 'question_id', 'id');
    }

    public function translationQuestion(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(QuestionTranslation::class, 'question_kk');
    }
    public function translationQuestionRU(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(QuestionTranslation::class, 'question_ru');
    }

    public function questionRu(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Question::class, QuestionTranslation::class, 'question_kk', 'id', 'id', 'question_ru');
    }
    public function questionKk(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Question::class, QuestionTranslation::class, 'question_ru', 'id', 'id', 'question_kk');
    }
}
