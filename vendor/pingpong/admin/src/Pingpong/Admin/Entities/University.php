<?php namespace Pingpong\Admin\Entities;

use Pingpong\Presenters\Model;
use DB;
class University extends Model
{

    /**
     * @var string
     */
    protected $presenter = 'Pingpong\Admin\Presenters\University';

    /**
     * @var array
     */
    protected $fillable = [
        'universityName',
		'cityID',
		'Overview',
        'Academics',
        'MyCampus',
         'Studentlife' ,
        'Surrounding', 
        'Accessibility',
		'image',
		'banner_image',
		'Consolidated',
		'Airlines',
		'Accommodation',
		'visa',
		'TravelInsurance',
		'Packing',
		'pck_cntn',
		
			];

   public static function getTotalSubs() {
	
		$universities = DB::table('universities')
						->count();
    	
		return $universities; 
	}
	
	 public function city()
    {
        return $this->belongsTo('App\City','cityID');
    }
	
	 public function universitycontent()
    {
        return $this->hasOne('Pingpong\Admin\Entities\UniversityContent','universityId');
    }

    public function universityCity($id){
        $city = $this->city()->find($id);
        return $city;
    }

    public function country()
    {
        $cityID = $this->city->cityID;
        $country = City::where('cityID', $cityID)->first();
        return $country;
    }
    
}
