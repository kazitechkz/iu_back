<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MethodistContentStat
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $sub_category_id
 * @property int|null $step_id
 * @property int|null $sub_step_id
 * @property int|null $sub_step_content_id
 * @property int|null $sub_step_tests_id
 * @property int|null $sub_step_video_id
 * @property int|null $created_user
 * @property int|null $updated_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category|null $category
 * @property User|null $user
 * @property Step|null $step
 * @property SubCategory|null $sub_category
 * @property SubStepContent|null $sub_step_content
 * @property SubStep|null $sub_step
 * @property SubStepTest|null $sub_step_test
 * @property SubStepVideo|null $sub_step_video
 *
 * @package App\Models
 */
class MethodistContentStat extends Model
{
    use CRUD;
	protected $table = 'methodist_content_stats';

	protected $casts = [
		'category_id' => 'int',
		'sub_category_id' => 'int',
		'step_id' => 'int',
		'sub_step_id' => 'int',
		'sub_step_content_id' => 'int',
		'sub_step_tests_id' => 'int',
		'sub_step_video_id' => 'int',
		'created_user' => 'int',
		'updated_user' => 'int'
	];

	protected $fillable = [
		'category_id',
		'sub_category_id',
		'step_id',
		'sub_step_id',
		'sub_step_content_id',
		'sub_step_tests_id',
		'sub_step_video_id',
		'created_user',
		'updated_user'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_user');
	}

	public function step()
	{
		return $this->belongsTo(Step::class);
	}

	public function sub_category()
	{
		return $this->belongsTo(SubCategory::class);
	}

	public function sub_step_content()
	{
		return $this->belongsTo(SubStepContent::class);
	}

	public function sub_step()
	{
		return $this->belongsTo(SubStep::class);
	}

	public function sub_step_test()
	{
		return $this->belongsTo(SubStepTest::class, 'sub_step_tests_id');
	}

	public function sub_step_video()
	{
		return $this->belongsTo(SubStepVideo::class);
	}
}
