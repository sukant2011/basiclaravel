<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use View;
use Route;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	

    public function __construct() {
		
        $tempArr = explode('@', Route::currentRouteAction());
		
		$routeController = class_basename($tempArr[0]);
		$routeAction =  $tempArr[1];
		
		
	   View::share ( 'routeController',  $routeController);
       View::share ( 'routeAction',  $routeAction);
    }  


}
