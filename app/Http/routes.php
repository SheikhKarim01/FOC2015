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

$app->get('/draw/{id}/{x}/{y}', function($id, $x, $y) use ($app) {
	$painting = \App\Painting::find($id);

	if ($y != 0) {
		$tile_above = $painting->tiles()
		->where('x', '=', $x)
		->where('y', '=', $y-1)->get()->first()->url;
	} else {
		$tile_above = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=300%C3%97300&w=300&h=300';
	}

	if ($y != 2) {
		$tile_below = $painting->tiles()
		->where('x', '=', $x)
		->where('y', '=', $y+1)->get()->first()->url;
	} else {
		$tile_below = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=300%C3%97300&w=300&h=300';
	}

	$tile_left= $painting->tiles()
	->where('x', '=', $x-1)
	->where('y', '=', $y)->get()->first();

	$tile_right = $painting->tiles()
	->where('x', '=', $x+1)
	->where('y', '=', $y)->get()->first();

    return view('draw')
    ->with('tile_above', $tile_above)
    ->with('tile_below', $tile_below)
    ->with('tile_left', $tile_left)
    ->with('tile_right', $tile_right);
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
	$median = (int)(((sqrt($painting->tileNumber) + 1) / 2) - 1);
               
     $centerTile = $painting->tiles()
		->where('x', '=', $median)
		->where('y', '=', $median)
		->get()->first(); 
 


	if ($centerTile->isLocked === 0) {
		return redirect('/draw/' . $painting->id . '/' . $centerTile->x . '/' . $centerTile->y);
	}
	else {
			for ($i=0; $i < 1; $i++) { 
				# code...
			
 			$randomTile = $painting->tiles()
 			->where('isLocked', '=', 0)
 			->get()
 			->random(1);


			return redirect('/draw/' . $painting->id . '/' . $randomTile->x . '/' . $randomTile->y);
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

