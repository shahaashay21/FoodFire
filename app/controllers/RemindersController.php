<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$credentials = array('email' => Input::get('email'), 'type' => Input::get('type'));
		switch ($response = Password::remind($credentials, function($message){ $message->subject('Password Reminder'); }))
		{
			case Password::INVALID_USER:
				return json_encode("invalid email");

			case Password::REMINDER_SENT:
				return json_encode("reminder sent");
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		if (is_null($token)) App::abort(404);

		// return View::make('password.reset')->with('token', $token);
		Session::flash("reset-form",$token);

		return Redirect::route('index');
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return json_encode('invalid password');
			case Password::INVALID_TOKEN:
				return json_encode('invalid token');
			case Password::INVALID_USER:
				// return Redirect::back()->with('error', Lang::get($response));
				return json_encode('invalid user');

			case Password::PASSWORD_RESET:
				// return Redirect::to('/');
			return json_encode('YES');
		}
	}

}
