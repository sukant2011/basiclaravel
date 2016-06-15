<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use DB;
use Session;

class BulkController extends BaseController
{
	

	
	public function store(Request $request)
    {
			
			
			$users = DB::table('exchangestudents')
                    ->whereIn('user_id',$request->userid)
					 ->update(['type' => $request->type]);
					
			Session::flash('flash_message','You have successfully performed the action.');
			return redirect('admin/users');
    }
	
}