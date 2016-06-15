<?php

namespace App\Http\Controllers;
use App\User;
use App\ExchangeStudent;
use App\Http\Requests\ExchangeStudentFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Redirect;
use Validator;
use App\University;
use App\City;
use App\Country;
use Auth;
use App\ImageUploader;
use App\UserType;
use Image;

class UpdateController extends Controller
{

	private $exchangeStudent;
	protected $uploader;

    public function __construct(ExchangeStudent $exchangeStudent,ImageUploader $uploader)
    {
        $this->exchangeStudent = $exchangeStudent;
		$this->uploader = $uploader;	
    }
	
	
    /**
     * Show the form to update basic profile
     *
     * @return Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
		$exchangeDetail = ExchangeStudent::whereUserId($user_id)->with(['homeUniversity','hostUniversity','hostUniversity.city.country'])->first();
		
		$homeUnivList = University::whereIn('cityID', array('147'))->orderBy('universityName')->lists('universityName','id');
	
		//$homeUnivList = University::whereIn('universityName', $this->listOfSgUniversity())->orderBy('universityName')->lists('universityName', 'id');
		
        $homeUnivList = $this->changeOrderForUniversityOthersOption($homeUnivList, false);
		
		$hostUnivList = University::whereNotIn('cityID',  array('147'))->orderBy('universityName')->lists('universityName', 'id');
		
		$hostUnivList = $homeUnivList + $hostUnivList;
		
		
		$homeUnivList = $hostUnivList;
		
		
		//$hostUnivList = $this->changeOrderForUniversityOthersOption($hostUnivList, true);

        $countryList = Country::orderBy('countryName')->lists('countryName', 'countryID');
		
		$userTypes = UserType::orderBy('id')->lists('title', 'id');
		
		return view('users.edit',compact('homeUnivList', 'hostUnivList', 'countryList','exchangeDetail','userTypes'));
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
	    $messages = array(
		 	'fname.required' => 'This field is required',
			'lname.required' => 'This field is requ ired',
			'email.required' => 'This field is required',
			'contact.required' => 'This field is required',
			'email.email' => 'Please enter valid email address',
		);
		
	    $rules = array(
						'fname' => 'required',
						'lname' => 'required',
					    'email' => 'required|email',
						/*'contact' => 'required|Min:10',*/ 
						
				  	  );
	    $validator = Validator::make($data, $rules, $messages);
	    if ($validator->fails()){
			return Redirect::to('/edit-profile')->withInput()->withErrors($validator);
	    }
	    else{
			
			if($this->emailExist($data['email'],$data['id'])=='1') {
				Session::put('custom_error','Email Address already exists. Please try with different email address!');
				
			}else {
				if(!empty($data['password'])){
				 DB::table('users')
				->where('id', $data['id'])
				->update([
						'fname' => $data['fname'],
						'lname' => $data['lname'],
						'email' => $data['email'],
						'password' => bcrypt($data['password']),
				]);
				}else{
						DB::table('users')
				->where('id', $data['id'])
				->update([
						'fname' => $data['fname'],
						'lname' => $data['lname'],
						'email' => $data['email'],
						//'password' => has($data['password']),
				]);
				}
			
	
				Session::put('custom_success','You have successfully updated your profile.');
				
			}
			return Redirect::to('/home');
	    }
    }
	
	public function emailExist($email = NULL, $userId = NULL) {
		
		$flag = '0';
		if($email!='' && $userId!=''){
			$user =  DB::table('users')
            						->where('id', '!=', $userId)
									->where('email', '=', $email)
									->first();
			if($user) {
				$flag = '1';
			}
		}
		return $flag;	
	}
	
	 /**
	 * Show the form for update exchange information
	 *
	 * @return Response
	 */
    public function exchange()
    {
		$user_id = Auth::user()->id;
		$exchangeDetail = ExchangeStudent::whereUserId($user_id)->with(['homeUniversity','hostUniversity','hostUniversity.city.country'])->first();
		
		$homeUnivList = University::whereIn('cityID', array('147'))->orderBy('universityName')->lists('universityName','id');
	
		//$homeUnivList = University::whereIn('universityName', $this->listOfSgUniversity())->orderBy('universityName')->lists('universityName', 'id');
		
        $homeUnivList = $this->changeOrderForUniversityOthersOption($homeUnivList, false);
		
		$hostUnivList = University::whereNotIn('cityID',  array('147'))->orderBy('universityName')->lists('universityName', 'id');
		
		
		
		
		$hostUnivList = $homeUnivList + $hostUnivList;
		
		
		$homeUnivList = $hostUnivList;
		
		
		//$hostUnivList = $this->changeOrderForUniversityOthersOption($hostUnivList, true);

        $countryList = Country::orderBy('countryName')->lists('countryName', 'countryID');
		
		return view('users.exchange',compact('homeUnivList', 'hostUnivList', 'countryList','exchangeDetail'));
    }
	
	public function changeOrderForUniversityOthersOption($listOfUni, $isTop)
    {
        $others = array_search('Others', $listOfUni);
        // remove others from the array
        unset($listOfUni[$others]);
        if ($isTop) {
            // put others option at the top of the array
            $first = array();
            $first[$others] = "Others";
            $listOfUni = $first + $listOfUni;
        } else {
            // put others at the end of the array
            $listOfUni[$others] = "Others";
        }
        return $listOfUni;
    }
	
	
	public function getUniversityCountryName(Request $request){
        $requestedData = $request->all();
		$id = $requestedData['id'];
		
        $uniCountry = University::find($id)->city->country;
		
        return json_encode(array('success' => true, 'data' => $uniCountry->countryName, 'id'=>$id));
    }
	
	 /**
     * Store a newly created resource in storage.
     *
     * @param ExchangeStudentFormRequest $request
     * @return Response
     */
    public function exchange_store(ExchangeStudentFormRequest $request)
    {
			
			$data = $request->all();
	    
			if($this->emailExist($data['email'],$data['id'])=='1') {
				Session::put('custom_error','Email Address already exists. Please try with different email address!');
				return Redirect::to('/edit-profile');
			}else {
				if(!empty($data['password'])){
					 DB::table('users')
									->where('id', $data['id'])
									->update([
											'fname' => $data['fname'],
											'lname' => $data['lname'],
											'email' => $data['email'],
											'password' => bcrypt($data['password']),
									]);
				}else{
						DB::table('users')
										->where('id', $data['id'])
										->update([
												'fname' => $data['fname'],
												'lname' => $data['lname'],
												'email' => $data['email'],
												//'password' => has($data['password']),
										]);
				}
			}
	
	    
			$user_id = $request->id;
            
            $student = ExchangeStudent::whereUserId($user_id)->first();
			
			$studentArr = array();
			
			$studentType = $request->type;
			
			$studentArr['user_id'] = $user_id;
			$studentArr['homeUniversityID'] = $request->homeUniversityID;
			$studentArr['exchangeTerm'] = $request->exchangeTerm;
			$studentArr['matriculationYear'] = $request->matriculationYear;
			$studentArr['hostUniversityID'] = $request->hostUniversityID;
			$studentArr['type'] = (int)$studentType;
			
			if($studentArr['type'] === 3 || $studentArr['type'] === 4){
				$studentArr['exchangeTerm'] = '';
				$studentArr['hostUniversityID'] = 0;
			}

			
			// user choose 'Others" home university option
			if ($studentArr['homeUniversityID'] == 1) {
				// create new host city
				$cityName = $this->nameize($request->homecity);
				$isCityExist = City::where('cityName', 'like', '%' . $cityName . '%')->where('countryID', '=', $request->homecountry )->count();
				// check if city exist
				if ($isCityExist == 0) {
					$newCity = ['cityName' => $cityName, 'countryID' => $request->homecountry];
					City::create($newCity);
				}

				$universityName = $this->nameize($request->homeuniversityName);
				// check if university exist
				$isUniversityExist = University::where('universityName', 'like', '%' . $universityName . '%')->count();
				if ($isUniversityExist == 0) {
					// get the city ID
					//$cityID = City::select("id")->where("cityName", $cityName)->first();
					$cityID = City::select("id")->where("cityName", $cityName)->where('countryID', '=', $request->homecountry )->first();
					$newUniversity = ['universityName' => $universityName, 'cityID' => $cityID->id];
					University::create($newUniversity);
					$newUniID = University::select("id")->where('universityName', '=', $universityName)->first();
					$studentArr['homeUniversityID'] = $newUniID->id;
				}
			}
			
			
			if(in_array($studentType,array('1','2'))){
				// user choose 'Others" host university option
				if ($studentArr['hostUniversityID'] == 1) {
					// create new host city
					$cityName = $this->nameize($request->hostcity);
					$isCityExist = City::where('cityName', 'like', '%' . $cityName . '%')->where('countryID', '=', $request->hostNewcountry )->count();
					// check if city exist
					if ($isCityExist == 0) {
						$newCity = ['cityName' => $cityName, 'countryID' => $request->hostNewcountry];
						City::create($newCity);
					}

					$universityName = $this->nameize($request->hostuniversityName);
					// check if university exist
					$isUniversityExist = University::where('universityName', 'like', '%' . $universityName . '%')->count();
					if ($isUniversityExist == 0) {
						// get the city ID
						$cityID = City::select("id")->where("cityName", $cityName)->where('countryID', '=', $request->hostNewcountry )->first();
						$newUniversity = ['universityName' => $universityName, 'cityID' => $cityID->id];
						University::create($newUniversity);
						$newUniID = University::select("id")->where('universityName', '=', $universityName)->first();
						$studentArr['hostUniversityID'] = $newUniID->id;
						
					}
				}
			}
			
			
			
			if(!$student) {
				if(ExchangeStudent::create($studentArr)) {
					Session::put('custom_success','You have successfully updated your Exchange / International studies details!');
					return Redirect::to('/home');
				}else {
					Session::put('custom_error','Some problem occur. Please try again!');	
				}
			}else {
				if(ExchangeStudent::where('user_id', $studentArr['user_id'])->update($studentArr)) {
					Session::put('custom_success','You have successfully updated your Exchange / International studies details!');
					return Redirect::to('/home');
				}else {
					Session::put('custom_error','Some problem occur. Please try again!');
				}
			}
			
			
			
    }
	
	function nameize($str,$a_char = array("'","-"," ")){
        //$str contains the complete raw name string
        //$a_char is an array containing the characters we use as separators for capitalization. If you don't pass anything, there are three in there as default.
        $string = strtolower($str);
        foreach ($a_char as $temp){
            $pos = strpos($string,$temp);
            if ($pos){
                //we are in the loop because we found one of the special characters in the array, so lets split it up into chunks and capitalize each one.
                $mend = '';
                $a_split = explode($temp,$string);
                foreach ($a_split as $temp2){
                    //capitalize each portion of the string which was separated at a special character
                    $mend .= ucfirst($temp2).$temp;
                }
                $string = substr($mend,0,-1);
            }
        }
        return ucfirst($string);
    }
	
	public function uploadImage(Request $request){
        $requestedData = $request->all();
		$userId = $requestedData['userId'];
		
		ini_set('memory_limit','750M');
		ini_set('upload_max_filesize','750M');
		
	
		
		if($_FILES['uploadfile']['name']!="")
		{
			$uploadFolder="memberImages";	
			$logoWidth = "100";
			$logoHeight = "100";
			$logoSize="5242880";
			$logoKb = '5 MB';
			
			
			$imgName = pathinfo($_FILES['uploadfile']['name']);
			$file = $_FILES['uploadfile'];
			$image = $_FILES['uploadfile']['name'];
			$ext = trim(substr($image, strrpos($image,'.')));
			
			$explodeExt = explode('.',$image);
			$explodeExt =  end($explodeExt);
			
			
			if($explodeExt=='jpg' || $explodeExt=='jpeg' || $explodeExt=='png' || $explodeExt=='gif' || $explodeExt=='bmp')
			{
				if($_FILES['uploadfile']['size'] <= $logoSize)
				{
					
						$this->uploader->upload('uploadfile')->save('img/memberImages','front');

						$imageName = $this->uploader->getFilename();
					
						$imgStatus = 1;

					
					DB::table('users')->where('id','=',$userId)->update(['avatar'=>$imageName]);
					
					echo  "success:".$imageName.':uploaded';
					if($imgStatus == 1)
					{
						Session::put('custom_success','Your profile picture has been successfully updated.');
					}
				}
				else
				{
					Session::put('custom_error',"File size should be less than $logoKb.");
					echo  "error:File size should be less than $logoKb.";
				}
			}
			else
			{
				Session::put('custom_error',"Only JPG, PNG, BMP or GIF files are allowed!");
				echo  "error:Only JPG, PNG, BMP or GIF files are allowed!";
			}
		}
		else
		{
			Session::put('custom_error',"Some error occur. Please try again!");
			echo  "error:Some error occur. Please try again!";
		}
		
		
		die;
    }
	
	/**
	* Function to generate random string
	*/
	public function RandomStringGenerator($length = 10)
	{       
	  $string = "";
	  $pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		for($i=0; $i<$length; $i++)
		{
			$string .= $pattern{rand(0,61)};
		}
		return $string;
	}
	
	public function connect() {


		$homeUnivList = University::whereIn('cityID', array('147'))->orderBy('universityName')->lists('universityName','universityName');
	    unset($homeUnivList['Others']);
        //$homeUnivList = $this->changeOrderForUniversityOthersOption($homeUnivList, false);
		
		$hostUnivList = University::whereNotIn('cityID',  array('147'))->orderBy('universityName')->lists('universityName', 'universityName');

		$hostUnivList = $homeUnivList + $hostUnivList;

		$homeUnivList = $hostUnivList;

        $countryList = Country::orderBy('countryName')->lists('countryName', 'countryName');
		
		if(Auth::check()) {
		
		$isUserAddedExchange = ExchangeStudent::where('user_id','=',Auth::user()->id)->count();
		
		if($isUserAddedExchange==0) {
			Session::put('custom_error',"Please update your Exchange / International studies details under \"Profile\".");
		}
		
		$peersExchanges = ExchangeStudent::
        join('universities as home', 'exchangestudents.homeUniversityID','=', 'home.id')
            ->join('universities as host', 'exchangestudents.hostUniversityID','=', 'host.id')
			->join('users', 'exchangestudents.user_id','=', 'users.id')
            ->join('cities', 'host.cityID', '=', 'cities.id')
            ->join('countries', 'cities.countryID', '=', 'countries.countryID')
            ->select('exchangestudents.id as eId','home.universityName as homeUniversity', 'matriculationYear as year', 'host.universityName as hostUniversity', 'exchangeTerm', 'countries.countryName as hostCountry','users.fname','users.lname','users.avatar','users.avatar','users.id as userId')
            ->where('hostUniversityID', '<>', '0')
			->where('type', '=', '1')
			//->where('user_id', '<>', Auth::user()->id)
             ->orderBy('users.fname', 'asc')
            ->get()->toArray();
			
		$seniorExchanges = ExchangeStudent::
        join('universities as home', 'exchangestudents.homeUniversityID','=', 'home.id')
            ->join('universities as host', 'exchangestudents.hostUniversityID','=', 'host.id')
			->join('users', 'exchangestudents.user_id','=', 'users.id')
            ->join('cities', 'host.cityID', '=', 'cities.id')
            ->join('countries', 'cities.countryID', '=', 'countries.countryID')
            ->select('exchangestudents.id as eId','home.universityName as homeUniversity', 'matriculationYear as year', 'host.universityName as hostUniversity', 'exchangeTerm', 'countries.countryName as hostCountry','users.fname','users.lname','users.avatar','users.id as userId' )
            ->where('hostUniversityID', '<>', '0')
			->where('type', '=', '2')
			//->where('user_id', '<>', Auth::user()->id)
            ->orderBy('users.fname', 'asc')
            ->get()->toArray();	

				$seniorsExchanges=array();
				$seniorsExchangesWithImg=array();
				$seniorsExchangesWithoutImg=array();
				
				foreach($seniorExchanges as $key=>$custseniors){
							if(!empty($custseniors['avatar'])){
										$seniorsExchangesWithImg[$custseniors['eId']]=$custseniors;
										
							}else{
									$seniorsExchangesWithoutImg[$custseniors['eId']]=$custseniors;
							} 
						
				}
				
				$seniorsExchanges = $seniorsExchangesWithImg + $seniorsExchangesWithoutImg;
				
					
					$peerExchanges=array();
					$peerExchangesWithImg=array();
					$peerExchangesWithoutImg=array();
					
					foreach($peersExchanges as $custpeer){
							if(!empty($custpeer['avatar'])){
										$peerExchangesWithImg[$custpeer['eId']]=$custpeer;
										
							}else{
									$peerExchangesWithoutImg[$custpeer['eId']]=$custpeer;
							} 
						
					}
					
					$peerExchanges=$peerExchangesWithImg + $peerExchangesWithoutImg;
		
		}else {
			
			if(@$_GET['from']=='email'){
				Session::put('custom_error',"Please log in to view your messages and reply");
			}
			

			$peerExchanges = array();
			$seniorsExchanges  = array();
		}
        
		//echo '<pre>';print_r($peerExchanges);die;
		return view('users.connect',compact('homeUnivList', 'hostUnivList', 'countryList','peerExchanges','seniorsExchanges','isUserAddedExchange'));
    }
	
	
	
}