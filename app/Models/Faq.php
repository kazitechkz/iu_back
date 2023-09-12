<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property bool $is_active
 * @property int $locale_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Locale $locale
 *
 * @package App\Models
 */
class Faq extends Model
{
    use CRUD, Language;
	protected $table = 'faqs';

	protected $casts = [
		'is_active' => 'bool',
		'locale_id' => 'int'
	];

	protected $fillable = [
		'question',
		'answer',
		'is_active',
		'locale_id'
	];

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}
}
