<?php namespace Pingpong\Admin\Entities;

use Pingpong\Presenters\Model;
use DB;
class Review extends Model
{

    /**
     * @var string
     */
    protected $presenter = 'Pingpong\Admin\Presenters\Review';

    /**
     * @var array
     */
   protected $fillable = [
        'universityId',
        'userId',
        'message'
    ];
	
	 public function userdetail()
    {
        return $this->belongsTo('App\User','userId');
    }
	
	 public function univdetail()
    {
        return $this->belongsTo('App\University','universityId');
    }
}
