<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Letter;
use App\Mail\SendMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class MailSend.
 * Single action class for sending mails.
 *
 * @author Nasibullin Rafael
 */
class MailSend extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param Request $request Request
	 *
	 * @return JsonResponse
	 *
	 * @throws ValidationException
	 */
	public function __invoke(Request $request): JsonResponse
	{
		$clientIp = $request->ip();
		$mail     = Letter::firstWhere(Letter::ATTR_IP, $clientIp);

		//Response an error if ip address is already in database.
		if (null !== $mail) {
			return response()->json("Sorry! You can't send more than one mail!", 400);
		}

		//Check if message is not empty.
		$validator = Validator::make($request->all(), [
			Letter::ATTR_MESSAGE => 'required|min:3|max:1000',
		]);

		//Response an error if validation fails.
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		//Create letter object and send mail.
		} else {
			$message       = $validator->validated()[Letter::ATTR_MESSAGE];
			$mail          = new Letter;
			$mail->ip      = $clientIp;
			$mail->message = $message;
			$mail->save();

			Mail::send(new SendMail($message));

			return response()->json('Letter successfully sent!', 201);
		}
	}
}
