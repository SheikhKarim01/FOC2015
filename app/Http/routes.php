<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {


	$paintings = \App\Painting::all();
    return view('index')
    	->with('paintings', $paintings);
});



$app->get('/{id}', function($id) use ($app) {


	$painting = \App\Painting::find($id);

	return $centerTile = $painting->tiles()
		->where('x', '=', '1')
		->where('y', '=', '1')
		->get(); 




	return;
    //return view('')
    	//->with('painting', $painting);
});