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
		'right',
		'time_taken'
		
	];

	public function question()
	{
		return $this->belongsTo(Question::class, 'question_id');
	}

    public function isAnswer()
	{
		if($this->question->answer == $this->answer)
			return 1;
		return 0;
	}


	public function parse()
	{
		return [
			'id' => $this->id,
			'answer' => $this->answer,
			'right'=>$this->right,
			'question' => $this->question ? $this->question->parseWithAnswer() : null,
		];
	}

}
