<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WebproviseTravel
 * 
 * @property int $id
 * @property Carbon $createdAt
 * @property string $employeeName
 * @property string $departure
 * @property string $destination
 * @property float $price
 * @property int $companyId
 * 
 * @property WebproviseCompany $webprovise_company
 *
 * @package App\Models
 */
class WebproviseTravel extends Model
{
	protected $table = 'webprovise_travels';
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'companyId' => 'int'
	];

	protected $dates = [
		'createdAt'
	];

	protected $fillable = [
		'createdAt',
		'employeeName',
		'departure',
		'destination',
		'price',
		'companyId'
	];

	public function webprovise_company()
	{
		return $this->belongsTo(WebproviseCompany::class, 'companyId');
	}
}
