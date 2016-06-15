<?php 
namespace App\Http\Controllers;
use Redirect;
use Socialize;
use App\AuthenticateUser;
use Illuminate\Http\Request;

class AccountController extends Controller {
  
	private $authenticateUser;
  // To redirect facebook
  //remove AuthenticateUser $authenticateUser, Request $request, $provider = null (to get old working from function param)
  public function facebook_redirect(AuthenticateUser $authenticateUser, Request $request, $provider = null) {
	  //echo '<pre>';print_r($request->all());die;
	return $authenticateUser->execute($request->all(), $this, $provider);
  //  return Socialize::with('facebook')->redirect();
  }
  // to get authenticate user data
  public function facebook() {
    $user = Socialize::with('facebook')->user();
    // Do your stuff with user data.
   // echo '<pre>';print_r($user);die;
    //return Redirect::to('/home');
  }
  
  public function userHasLoggedIn($user) {
    \Session::flash('message', 'Welcome, ' . $user->username);
    return redirect('/connect');
  }
  
  public function connect() {
  	return view('users.connect');
  }
}