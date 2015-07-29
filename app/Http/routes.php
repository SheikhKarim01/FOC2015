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


use Illuminate\Http\Request;



$app->get('/', function() use ($app) {


	$paintings = \App\Painting::all();
    return view('index')
    	->with('paintings', $paintings);
});

$app->get('/draw', function() use ($app) {
    return view('draw');
});

$app->get('/submit', function() use($app) {
	return "hey";
});

$app->post('/submit', function(Request $request) use($app) {
	$data = $request->input('imgBase64');
	$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
	file_put_contents('img/upload.png', $data);
});

$app->get('/{id}', function($id) use ($app) {



	$painting = \App\Painting::find($id);
	$median = (((sqrt($painting->tileNumber) + 1) / 2) - 1);
               
     $centerTile = $painting->tiles()
		->where('x', '=', $median)
		->where('y', '=', $median)
		->get()->first(); 


	if ($centerTile->isLocked === 0) {
		return $centerTile;
	} else {

	}



	return;
    //return view('')
    	//->with('painting', $painting);
});

