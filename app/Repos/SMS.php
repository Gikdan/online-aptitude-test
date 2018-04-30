<?php

namespace App\Repos;

use App\Models\Sms as SmsModel;

class SMS
{
	private $to, $message, $reason;

	public static function init($reason = "")
	{
		$instance = new self;
		$instance->reason = $reason;

		return $instance;
	}

	public function to($phone_number)
	{
		$this->to = $phone_number;

		return $this;
	}

	public function message($message)
	{
		$this->message = $message;

		return $this;
	}

	public function send()
	{ 
		if ($this->to == "" || $this->message == "") {
			abort(422, 'Invalid Request');
		}
		
        $smslength = strlen($this->message);
        if ($smslength<=160) {
            $noofsms = 1;
        } else {
            $noofsms = ceil($smslength/160);
        }
		// Infobip's POST URL
		$postUrl = "http://api.infobip.com/api/v3/sendsms/xml";
		// XML-formatted data
		$xmlString =
		"<SMS>
		<authentification>
		<username>MCBC</username>
		<password>modern123</password>
		</authentification>
		<message>
		<sender>ModernCoast</sender>
		<text>" . $this->message . "</text>
		</message>
		<recipients>
		<gsm>" . $this->to . "</gsm>
		</recipients>
		</SMS>";
		
		$fields = "XML=" . urlencode($xmlString);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($ch);
		curl_close($ch);

		SmsModel::create([
			'SMS_Length' => strlen($this->message),
			'SMS_NO_Sent' => ceil($smslength/160),
			'SMS_Recipient' => $this->to,
			'SMS_Function' => $this->reason,
			'status' => 1
		]);
		
		return $response;
	}
}