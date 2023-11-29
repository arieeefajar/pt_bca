<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatGptController extends Controller
{
	public function index(Request $request)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . env('OPENAI_API_KEY') ?? '',
		]);
		$message = '{
			"model": "gpt-3.5-turbo",
			"messages": [
				{
					"role": "user",
					"content": "' . $request->message . '"
				}
			],
			"temperature": 1,
			"max_tokens": 256,
			"top_p": 1,
			"frequency_penalty": 0,
			"presence_penalty": 0
		}';
		// $message = json_encode($message);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		$response = curl_exec($ch);

		curl_close($ch);
		return $response;

	}
}
