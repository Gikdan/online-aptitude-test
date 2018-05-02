<?php

function parse_phone_number($number)
{
	$country_code = (int) substr($number, 0, 3);

	if ($country_code != 254 && $country_code != 255 && $country_code != 256 && $country_code != 250) {
		abort(422, 'Invalid Phone Number');
	}

	return $number;
}



function auth_user()
{ 
	return App\Models\User::getAll(auth()->guard('api')->id())->parse();
}