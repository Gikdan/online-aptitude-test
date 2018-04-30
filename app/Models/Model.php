<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as MainModel;

class Model extends MainModel
{
	protected $hidden = ['deleted_at'];

	protected $dates = ['created_at'];

	public static function getAll($id = null)
	{
		if ($id) {
			return self::findOrFail($id);
		}

		return self::get();
	}

	public function parse()
	{
		return $this->toArray();
	}

	public function id()
	{
		return $this->{$this->primaryKey};
	}
}