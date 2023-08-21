<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Bpuig\Subby\Models\Plan;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupPlan
 *
 * @property int $id
 * @property int $group_id
 * @property int $plan_id
 *
 * @property Group $group
 * @property Plan $plan
 *
 * @package App\Models
 */
class GroupPlan extends Model
{
    use CRUD;
	protected $table = 'group_plan';
	public $timestamps = false;

	protected $casts = [
		'group_id' => 'int',
		'plan_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'plan_id'
	];

	public function group()
	{
		return $this->belongsTo(Group::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
