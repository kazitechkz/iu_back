<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promocode
 *
 * @property int $id
 * @property string $code
 * @property Carbon $expired_at
 * @property array|null $plan_ids
 * @property array|null $group_ids
 * @property int $percentage
 * @property string|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Promocode extends Model
{
    use CRUD;

	protected $table = 'promocodes';

	protected $casts = [
		'expired_at' => 'datetime',
		'plan_ids' => 'json',
		'group_ids' => 'json',
		'percentage' => 'int'
	];

	protected $fillable = [
		'code',
		'expired_at',
		'plan_ids',
		'group_ids',
		'percentage',
		'details'
	];

//    protected function group_ids(): Attribute {
//        return Attribute::make(
//            get: function($value){
//                $ids = json_decode($value);
//                if(!is_array($ids)){
//                    return [];
//                }
//                return Hub::whereIn('id', $ids)->select([
//                    'id',
//                    'title_ru',
//                    'title_kk'
//                ])->get();
//            },
//        );
//    }
    protected function plan_ids(): Attribute {
        return Attribute::make(
            get: function($value){
                $ids = json_encode($value);
                $t1 = str_replace("\\", '', $ids);
                return str_replace('\\', '', $t1);
//                return explode(',', $t2);
            },
        );
    }

	public function users()
	{
		return $this->belongsToMany(User::class, 'promocode_users')
					->withPivot('id')
					->withTimestamps();
	}
}
