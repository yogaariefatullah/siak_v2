<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;
use Illuminate\Contracts\Encryption\DecryptException;

trait Guzzle
{

	public function sendmailService($email, $subject, $message)
	{
		try {
			$client = new Client();
			$response = $client->request('POST', 'http://172.16.0.49:8080/api/v1/mail/send', [
				'headers' => [
					'Content-Type'  => 'application/json',
				],
				'auth'  =>  ['djb_modi', 'm0d!_m!n3rb4'],
				'json' => ['receiver' => $email, 'subject' => $subject, 'content' => $message]
			]);

			$body = $response->getBody();

			//echo $body;
		} catch (DecryptException $e) {
			$response = $e->getMessage();
			return response()->json(['msg' => true, 'status' => false, 'response' => $response]);
		}
	}
}
