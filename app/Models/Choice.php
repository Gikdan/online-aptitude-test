<?php

namespace App\Models;

use App\Models\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Eloquent
{
	use SoftDeletes;
	
	protected $connection = 'mysql';
	protected $table = 'choices';
	protected $perPage = 20;
	public $timestamps = false;

	protected $fillable = [
		'description',
		'question_id'
	];


	public function parse()
	{
		return [
			'id' => $this->id,
			'description' => json_decode($this->description)
		];
	}
}
