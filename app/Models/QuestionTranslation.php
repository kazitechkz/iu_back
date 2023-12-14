<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class QuestionTranslation
 *
 * @property int $id
 * @property int $question_kk
 * @property int $question_ru
 * @property int $subject_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Question $question
 * @property Subject $subject
 *
 * @package App\Models
 */
class QuestionTranslation extends Model
{
    use CRUD;
	protected $table = 'question_translations';

	protected $casts = [
		'question_kk' => 'int',
		'question_ru' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'question_kk',
		'question_ru',
		'subject_id',
		'type_id',
		'group_id'
	];

    /**
     * @return BelongsTo $questionRU
     */
	public function questionRU(): BelongsTo
    {
		return $this->belongsTo(Question::class, 'question_ru');
	}

    /**
     * @return BelongsTo $questionKK
     */
    public function questionKK(): BelongsTo
    {
		return $this->belongsTo(Question::class, 'question_kk');
	}

	public function subject(): BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

    public static function searchableData($request = null, $isIndexPage = true): array
    {
        $subjects = Subject::all();
        $types = QuestionType::all();
        $groups = Group::all();
        if ($isIndexPage) {
            $questions = [];
        } else {
            $query = Question::where(['subject_id' => $request['subject_id'], 'type_id' => $request['type_id'], 'locale_id' => 1]);
            if ($request['group_id']) {
                $questions = $query->where('group_id', $request['group_id'])
                    ->with('translationQuestion')
                    ->latest()
                    ->paginate(20);;
            } else {
                $questions = $query->with('translationQuestion')
                    ->latest()
                    ->paginate(20);
            }
        }
        return compact('subjects', 'types', 'groups', 'questions');
    }
}
