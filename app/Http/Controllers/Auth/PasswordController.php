<?php namespace App\Http\Controllers\Auth;use App\Http\Controllers\Controller;use Illuminate\Contracts\Auth\Guard;use Illuminate\Contracts\Auth\PasswordBroker;use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Session;
class PasswordController extends Controller {	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/
	use ResetsPasswords;
	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */	public function __construct(Guard $auth, PasswordBroker $passwords)
	{		$this->auth = $auth;		$this->passwords = $passwords;		$this->middleware('guest');
	}
	public function postReset(Request $request)
    { 
			 $this->validate($request, [
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
			]);
			$credentials = $request->only(
				'email', 'password', 'password_confirmation', 'token'
			);
			$response = $this->passwords->reset($credentials, function($user, $password)
			{
				
				$user->password = $password;
				//echo '<pre>';print_r($user);die;
				$user->save();
				//$this->auth->login($user);
			});
			switch ($response)
			{
				case PasswordBroker::PASSWORD_RESET:
					Session::put('custom_success','You have successfully reset your password. Please try logging in again.');
					return view('auth.login');
					//return redirect($this->redirectPath());
				default:
					return redirect()->back()
								->withInput($request->only('email'))
								->withErrors(['email' => trans($response)]);
			}	
		
	}
}