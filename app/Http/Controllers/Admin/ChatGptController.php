<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatGptController extends Controller
{
	public function index(Request $request)
	{
		$endPointApi = "https://api.openai.com/v1/chat/completions";

		// return response()->json([
		// 	'message' => 'success',
		// 	'answer' => $request->message
		// ], 200);

		$dataSend = [
			"model" => "gpt-3.5-turbo",
			"messages" => [
				[
					"role" => "user",
					"content" => $request->message
				]
			],
			"temperature" => 1,
			"max_tokens" => 256,
			"top_p" => 1,
			"frequency_penalty" => 0,
			"presence_penalty" => 0
		];

		$response = Http::withHeaders([
			'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
		])->post($endPointApi, $dataSend);

		$responJson = $response->json()['choices'][0]['message']['content'];

		return response()->json([
			'message' => 'success',
			'answer' => $responJson
		], 200);
	}
}
