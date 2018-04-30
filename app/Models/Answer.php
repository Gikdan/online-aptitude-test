<?php

namespace App\Models;

use App\Models\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Eloquent
{
	use SoftDeletes;
	
	protected $connection = 'mysql';
	protected $table = 'answers';
	protected $perPage = 20;
	public $timestamps = false;

	protected $fillable = [
		'answer',
		'applicant_id',
		'question_id',
		'time_taken'
		
	];

	public function question()
	{
		return $this->belongsTo(Question::class, 'question_id');
	}

	public function parse()
	{
		return [
			'id' => $this->id,
			'answer' => $this->answer,
			'question' => $this->question ? $this->question : null,
		];
	}
}
