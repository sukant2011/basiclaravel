<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\UserRequest;
use App\User;
use App\ExchangeStudent;
use Illuminate\Contracts\Mail\Mailer;
use DB;
class UserRequestController extends Controller
{
    private $userrequest;
    private $mailer;
    public function __construct(UserRequest $userrequest,Mailer $mailer)
    {
        $this->userrequest = $userrequest;
		$this->mailer = $mailer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

		
		if($request->uId!='' && $request->toId!='' && $request->message!='') {
			$uId = $request->uId;
			$toId = $request->toId;
			$reqType = $request->reqType;
			
			$message = $request->message;

			$alreadyExist = UserRequest::where('to_id','=',$toId)->where('user_id','=',$uId)->select(['*',DB::raw("DATEDIFF('NOW()',created_at) AS Days")])->orderby('created_at','desc')->first();
			
			if($alreadyExist) {
				
				return json_encode(array('success' => true, 'data' => 'Already friend!'));
				
			}else{
				$saveRequestToDb = UserRequest::create(['user_id'=>$uId,'to_id'=>$toId,'type'=>$reqType]);
				
				if ($saveRequestToDb) {
					return json_encode(array('success' => true, 'data' => 'A friend request has been sent to the user!'));
				}
			}	
				
			

		}
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }



    
    // friendlistdetails
	// public function friendlistdetails()
	// {

	// 	if(Auth::check()) {
	// 		$userId =  Auth::user()->id;
	// 		$userData = User::where('id','=',$userId)->with(['exchange','exchange.homeUniversity','exchange.hostUniversity','exchange.userType','exchange.hostUniversity.city.country'])->first();
			
	// 		$rquest_send = DB::table('users as u')
	// 					->select(array('u.*'))
	// 					->join('user_requests as ur', 'ur.user_id','=','u.id')
	// 					->where('ur.to_id','=',$userId);
						
	// 		$rquest_recive = DB::table('users as u')
	// 					->select(array('u.*'))
	// 					->join('user_requests as ur', 'ur.to_id','=','u.id')
	// 					->where('ur.user_id','=',$userId)
	// 					->union($rquest_send);

	// 		$friendlist = DB::table( DB::raw("({$rquest_recive->toSql()}) as friend") )			
	// 					->mergeBindings($rquest_recive)
	// 					->orderBy(DB::raw('RAND()'))
	// 					->get();
			
	// 	 $htmlfrdlist = '<div class="chat-sidebar-main">
 // <div class="latu">


	// <div class="chat-sidebar" id="two" style="display: block;">
	// <h2>chat with friends <span class="glyphicon glyphicon-remove pull-right"></span></h2>
	// ';
	
	          
	            	
	// 		if(@count($friendlist)>0){
			

			

	// 			foreach ($friendlist as $friend) {
	
	// 			$htmlfrdlist .= '<div class="sidebar-name"><a href="javascript:register_popup(\'narayan-prusty\', \'Narayan Prusty\');">';
	// 				 if($friend->avatar!=''){ 
	// 							if((strpos($friend->avatar,'http://')!== false || strpos($friend->avatar,'https://')!== false)) {
					
	// 								$htmlfrdlist .= '<img src="'.str_replace('=normal','=large&width=200&height=200',$friend->avatar).'">';
	// 					}else { 
	// 								$htmlfrdlist .= '<img src="http://www.flyingchalks.com/dev/public/img/memberImages/'.$friend->avatar.'">';
	// 						} 
	// 						}else{ 
					
	// 							$htmlfrdlist .= '<img src="http://www.flyingchalks.com/dev/public/img/dummy.jpg">';
	// 					} 
	// 					$htmlfrdlist .= '<span class="name-cl">'. $friend->fname.' '.$friend->lname.'</span>';
	// 					$htmlfrdlist .= '<span class="online"></span>
	// 				</a>
	// 			</div>';
		
	// 			}
		
	// 		}
		

	//         $htmlfrdlist .= '</div>
	//         </div>

 //    </div> ';
 //    		echo  $htmlfrdlist;
 //    		exit;
	// 		//return json_encode(array("login"=>true,"friends"=>$friendlist));
	// 	}else{

	// 		echo 'false';
	// 		exit;
	// 		//return json_encode(array("login"=>false));
	// 	}
		
	// }

	public function friendlistdetails()
	{

		if(Auth::check()) {
			$userId =  Auth::user()->id;
			$userData = User::where('id','=',$userId)->with(['exchange','exchange.homeUniversity','exchange.hostUniversity','exchange.userType','exchange.hostUniversity.city.country'])->first();
			
			$rquest_send = DB::table('users as u')
						->select(array('u.*'))
						->join('user_requests as ur', 'ur.user_id','=','u.id')
						->where('ur.to_id','=',$userId);
						
			$rquest_recive = DB::table('users as u')
						->select(array('u.*'))
						->join('user_requests as ur', 'ur.to_id','=','u.id')
						->where('ur.user_id','=',$userId)
						->union($rquest_send);

			$friendlist = DB::table( DB::raw("({$rquest_recive->toSql()}) as friend") )			
						->mergeBindings($rquest_recive)
						->orderByRaw("field(friend.online ,'Y','N','') ASC")
						->orderBy("friend.fname","ASC")
						->get();
			
			return json_encode(array("login"=>true,"friends"=>$friendlist));
		}else{
			return json_encode(array("login"=>false));
		}
		
	}


	 public function friendslist(){
    	return view('users.friendslist');
    }



    public function logindetails(Request $request){
    	if ($request->ajax() || $request->wantsJson()) {
    		if(Auth::check()) {
    			$user =array("login"=>true,"id"=>Auth::user()->id,"image"=>Auth::user()->avatar,"fname"=>Auth::user()->fname,"lname"=>Auth::user()->lname,"email"=>Auth::user()->email);
    			return json_encode($user);
    		}else{
    			return json_encode(array("login"=>false));
    		}
    	}
    }


    public function sendMessageOffline(Request $request){
    	if ($request->ajax() || $request->wantsJson()) {
    		if(Auth::check()) {

    		    $reciever = User::where('id','=',$request->reciverId)->first()->toArray();
    			$sendToEmail = $reciever['email'];
				$sendToName = $reciever['fname'];
				
				

				$data=array('message'=>@$request->message,'reciever'=>$reciever);
				
				
				
				$this->mailer->send('emails.offlinemessage', compact('data'), function($message) use($sendToEmail, $sendToName) {
						$message->to($sendToEmail, $sendToName)
							->subject('Flying Chalks - New Message');
				});



    			return json_encode(array("login"=>true));
    		}else{
    			return json_encode(array("login"=>false));
    		}
    	}
    }

}

