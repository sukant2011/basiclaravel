<?php namespace Pingpong\Admin\Entities;

use Pingpong\Presenters\Model;
use DB;
class Subscriber extends Model
{

    /**
     * @var string
     */
    protected $presenter = 'Pingpong\Admin\Presenters\Subscriber';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
    ];

   public static function getTotalSubs() {
	
		$subscribers = DB::table('subscribers')
						->count();
    	
		return $subscribers; 
	}
    
}
