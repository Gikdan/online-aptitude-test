<?php

namespace App\Models;

use App\Models\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Eloquent
{
	use SoftDeletes;
	
	protected $connection = 'mysql';
	protected $table = 'categories';
	protected $perPage = 20;
	public $timestamps = false;

	protected $fillable = [
		'name'
	];


	public function parse()
	{
		return [
			'id' => $this->id,
			'name' => $this->name
		];
	}
}
