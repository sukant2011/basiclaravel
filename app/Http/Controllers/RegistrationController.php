<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Illuminate\Contracts\Auth\Guard; 


class RegistrationController extends Controller {

	private $auth;
	
    public function __construct(Guard $auth)
    {
        $this->beforeFilter('guest');
		$this->auth = $auth;
    }
	/**
	 * Show a form to register the user.
	 *
	 * @return Response
	 */
	
    /**
     * Attempt to confirm a users account.
     *
     * @param $confirmation_code
     *
     * @throws InvalidConfirmationCodeException
     * @return mixed
     */
    public function confirm($confirmation_code)
    {
		 $userdata=DB::table('users')
						->where('confirmation_code',$confirmation_code)
						->get();
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if ( ! $userdata)
        {
			Session::put('custom_error','Confirmation is code is wrong. Please try again.');
			return Redirect::to('/auth/register');
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->last_logged_in =date('Y-m-d H:i:s');
        $user->save();
		$this->auth->login($user, true);

        Session::put('custom_success','You are just one step away from connecting with other users! Please update your profile and Exchange / International Studies details to complete the process.');
		return Redirect::to('/edit-profile');
    }
}