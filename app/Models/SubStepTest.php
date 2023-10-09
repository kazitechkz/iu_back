<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Helpers\MathFormulaHelper;
use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubStepTest
 *
 * @property int $id
 * @property int $sub_step_id
 * @property int $sub_question_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Question $question
 * @property SubStep $sub_step
 *
 * @package App\Models
 */
class SubStepTest extends Model
{
    use CRUD;
	protected $table = 'sub_step_tests';

	protected $casts = [
		'sub_step_id' => 'int',
		'question_id' => 'int',
        'locale_id' => 'int'
	];

	protected $fillable = [
		'sub_step_id',
		'question_id',
        'locale_id'
	];

	public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Question::class)->select(['id','text','answer_a', 'answer_b', 'answer_c', 'answer_d', 'context_id', 'locale_id']);
	}

    public function subQuestion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id')->select(['id','text','answer_a', 'answer_b', 'answer_c', 'answer_d', 'context_id', 'locale_id', 'correct_answers']);
    }

	public function sub_step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubStep::class);
	}

    public function result(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubStepContentTest::class, 'id', 'test_id');
    }

    public static function createSubStepTest($request): void
    {
        $subStep = SubStep::findOrFail($request['sub_step_id']);
        $data = MathFormulaHelper::replace($request);
        $data['sub_category_id'] = $subStep->sub_category_id;
        $question = Question::add($data);
        $data['sub_step_id'] = $request['sub_step_id'];
        $data['question_id'] = $question->id;
        $data['locale_id'] = $question->locale_id;
        SubStepTest::add($data);
    }

    public function updateSubStepTest($request): void
    {
        $data = MathFormulaHelper::replace($request);
        $subStep = SubStep::findOrFail($request['sub_step_id']);
        $data['sub_category_id'] = $subStep->sub_category_id;
        $this->question->edit($data);
        $data['sub_step_id'] = $request['sub_step_id'];
        $data['question_id'] = $this->question->id;
        $data['locale_id'] = $this->question->locale_id;
        $this->fill($data);
        $this->save();
    }
}
