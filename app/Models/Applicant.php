<?php

namespace App\Models;

use App\Models\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Eloquent
{
	use SoftDeletes;
	
	protected $connection = 'mysql';
	protected $table = 'applicants';
	protected $perPage = 20;
	public $timestamps = false;

	protected $fillable = [
		'first_name',
		'last_name',
		'surname',
		'email',
		'phone_number',
		'id_number',
		'viewed',
		'access_code',
		'category_id'
	];


   public static function getApplicantId($access_code){
   	  return self::where('access_code', '=', $access_code)->value('id');
   }

   public function category()
	{
		return $this->belongsTo(Category::class);
	}

   public static function generateCode()
     {
    
        $number = strtoupper(str_random(10));

        $already_used = self::where('access_code', '=', $number)->count();

        if ($already_used == 0) {
            return $number;
        }
        return self::generateCode();
     }


	public function parse()
	{
		return [
			'id' => $this->id,
			'name' => $this->first_name . " " . $this->first_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'id_number' => $this->id_number,
			'viewed' => $this->viewed,
			'email' => $this->email,
			'access_code' => $this->access_code,
			'category' => $this->category ? [
				'id' => $this->category->id,
				'name' => $this->category->name				
			] : null
		];
	}
}
