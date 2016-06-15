<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class PagesController extends Controller {
    
	public function __construct()
    {
        $this->beforeFilter('guest');
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
    public function view($slug)
    {
		if($slug!=''){
			$pageData = DB::table('articles')
						->whereTypeAndSlug('page',$slug)
						->first();
			
			return view('home.cms',compact('pageData'));
		}
	
		/*
		
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if ( ! $userdata)
        {
			Session::put('custom_error','Confirmation is code is wrong. Please try again.');
			return Redirect::to('/auth/register');
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        Session::put('custom_success','You have successfully verified your email account. Now, You can login.');
		return Redirect::to('/auth/login');
    */
	}
}