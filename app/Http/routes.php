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

$app->get('/draw', function() use ($app) {
    return view('draw');
});



$app->get('/{id}', function($id) use ($app) {



	$painting = \App\Painting::find($id);
	$median = (int)(((sqrt($painting->tileNumber) + 1) / 2) - 1);
               
     $centerTile = $painting->tiles()
		->where('x', '=', $median)
		->where('y', '=', $median)
		->get()->first(); 
 


	if ($centerTile->isLocked === 0) {
		return $centerTile;
	}
	else {
			for ($i=0; $i < 1; $i++) { 
				# code...
			
 			$randomTile = $painting->tiles()
 			->where('isLocked', '=', 0)
 			->get()
 			->random(1);


			echo $randomTile;
		}

			/*echo '<p>';
			echo $x;
			echo $y;
			echo '</p>';*/
	}

			/*

		
			$randomTile = $painting->tiles()
			->where('x', '=', $x)
			->where('y', '=', $y)
			->get()->first();
			echo $randomTile;


		return $randomTile;*/
	
    //return view('')
    	//->with('painting', $painting);
});

