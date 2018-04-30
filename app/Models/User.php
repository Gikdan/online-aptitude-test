<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Roksta\Punctuator\Spacer;

class User extends Authenticatable
{
	use Notifiable, HasApiTokens, Spacer, SoftDeletes;

	protected $connection = 'mysql';
	protected $perPage = 20;
	public $timestamps = false;

	protected $casts = [
		'user_type_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'phone_number',
		'email',
		'username',
		'password',
        'user_type_id'
	];


	public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)
            ->orWhere('username', $identifier)
            ->first();
    }

    public function setPunctuateColumns(): Array
    {
        return ['short' => ['name'], 'long' => []];
    }


    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }



    public function parse()
    { 
    	return collect([
    		'id' => $this->id,
    		'name' => $this->name,
			'phone_number' => $this->phone_number,
			'email' => $this->email,
            'username' => $this->username,
            'type' => $this->userType->only(['id', 'name'])
            
    	]);
    }

    public static function getAll($id = null)
    {
    	if ($id) {
    		return self::with(['userType'])
    			->findOrFail($id);
    	}

    	return self::with(['userType'])
    			->get();
    }

}
