<?php

namespace App\Models;

use App\Models\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Eloquent
{
	use SoftDeletes;
	
	protected $connection = 'mysql';
	protected $table = 'questions';
	protected $perPage = 20;
	public $timestamps = false;

	protected $fillable = [
		'description',
		'category_id',
		'answer'
	];

	public function choices()
	{
		return $this->hasOne(Choice::class, 'question_id');
	}
    public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}


	public static function getAll($id = null)
	{
		if ($id) {
			return self::with(['choices'])->findOrFail($id);
		}

		return self::with(['choices'])->get();
	}

   public static function getNext($id = null){
   	
      if ($id) {
   	     $data=self::where('id', '>', $id)->first();
   	   }
   	 else
   	   $data=self::first();
      if($data !=null)
      	return $data->parse();
      //else
   }

	public function parse()
	{
		return [
			'id' => $this->id,
			'description' => $this->description,
			'category' => $this->category ? $this->category->name : 'Unknown',
			'choices' => $this->choices ? json_decode($this->choices->description) : null
		];
	}
	public function parseWithAnswer()
	{
		return [
			'id' => $this->id,
			'description' => $this->description,
			'category' => $this->category ? $this->category->name : 'Unknown',
			'answer' => $this->answer,
			'choices' => $this->choices ? json_decode($this->choices->description) : null
		];
	}
}
