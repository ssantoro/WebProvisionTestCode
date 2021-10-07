<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WebproviseCompany
 * 
 * @property int $id
 * @property Carbon $createdAt
 * @property string $name
 * @property int $parentId
 * 
 * @property WebproviseCompany $webprovise_company
 * @property Collection|WebproviseCompany[] $webprovise_companies
 * @property Collection|WebproviseTravel[] $webprovise_travels
 *
 * @package App\Models
 */
class WebproviseCompany extends Model
{
	protected $table = 'webprovise_companies';
	public $timestamps = false;

	protected $casts = [
		'parentId' => 'int'
	];

	protected $dates = [
		'createdAt'
	];

	protected $fillable = [
		'createdAt',
		'name',
		'parentId'
	];

	public function webprovise_company()
	{
		return $this->belongsTo(WebproviseCompany::class, 'parentId');
	}

	public function webprovise_companies()
	{
		return $this->hasMany(WebproviseCompany::class, 'parentId');
	}

	public function webprovise_travels()
	{
		return $this->hasMany(WebproviseTravel::class, 'companyId');
	}
}
