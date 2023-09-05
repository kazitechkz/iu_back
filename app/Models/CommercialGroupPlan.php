<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommercialGroupPlan
 * 
 * @property int $id
 * @property int $plan_id
 * @property int $group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CommercialGroup $commercial_group
 * @property Plan $plan
 *
 * @package App\Models
 */
class CommercialGroupPlan extends Model
{
	protected $table = 'commercial_group_plan';

	protected $casts = [
		'plan_id' => 'int',
		'group_id' => 'int'
	];

	protected $fillable = [
		'plan_id',
		'group_id'
	];

	public function commercial_group()
	{
		return $this->belongsTo(CommercialGroup::class, 'group_id');
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
