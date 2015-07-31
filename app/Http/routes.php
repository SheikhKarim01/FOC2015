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

$app->get('/preview', function() use ($app) {

	$preview = \App\Painting::all();
    return view('preview')
    	->with('preview', $preview);
});


$app->get('/draw/{id}/{x}/{y}', function($id, $x, $y) use ($app) {
	$painting = \App\Painting::find($id);


	// Top center tile
	if ($y != 0) {
		$tile_above = $painting->tiles()
		->where('x', '=', $x)
		->where('y', '=', $y-1)->get()->first()->url;
	} else {
		$tile_above = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Bottom center tile
	if ($y != 2) {
		$tile_below = $painting->tiles()
		->where('x', '=', $x)
		->where('y', '=', $y+1)->get()->first()->url;
	} else {
		$tile_below = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Left center tile
	if ($x !=0) {
		$tile_left= $painting->tiles()
		->where('x', '=', $x-1)
		->where('y', '=', $y)->get()->first()->url;
	} else {
		$tile_left = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Right center tile
	if ($x !=2) {
		$tile_right = $painting->tiles()
		->where('x', '=', $x+1)
		->where('y', '=', $y)->get()->first()->url;
	} else {
		$tile_right = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Bottom right tile
	if ($x !=2 && $y !=2) {
		$tile_br = $painting->tiles()
		->where('x', '=', $x+1)
		->where('y', '=', $y+1)->get()->first()->url;
	} else {
		$tile_br = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Bottom left tile
	if ($x !=0 && $y !=2) {
		$tile_bl = $painting->tiles()
		->where('x', '=', $x-1)
		->where('y', '=', $y+1)->get()->first()->url;
	} else {
		$tile_bl = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Top right tile
	if ($x !=2 && $y !=0) {
		$tile_tr = $painting->tiles()
		->where('x', '=', $x+1)
		->where('y', '=', $y-1)->get()->first()->url;
	} else {
		$tile_tr = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	// Top left tile
	if ($x !=0 && $y !=0) {
		$tile_tl = $painting->tiles()
		->where('x', '=', $x-1)
		->where('y', '=', $y-1)->get()->first()->url;
	} else {
		$tile_tl = 'https://placeholdit.imgix.net/~text?txtsize=28&bg=000000&txtclr=000000&txt=300%C3%97300&w=300&h=300';
	}

	
    return view('draw')
    ->with('tile_above', $tile_above)
    ->with('tile_below', $tile_below)
    ->with('tile_left', $tile_left)
    ->with('tile_right', $tile_right)
    ->with('tile_br', $tile_br)
    ->with('tile_bl', $tile_bl)
    ->with('tile_tr', $tile_tr)
    ->with('tile_tl', $tile_tl);
});


$app->get('/submit', function() use($app) {
	return "hey";
});

$app->post('/submit', function(Request $request) use($app) {
	$data = $request->input('imgBase64');
	$p = $request->input('p');
	$x = $request->input('x');
	$y = $request->input('y');
	$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));

	if (file_exists('img/' . $p)) {
		file_put_contents('img/' . $p . '/' . $x . $y . '.png', $data);
	} else {
		mkdir("img/" . $p . "/", 0700);
		file_put_contents('img/' . $p . '/' . $x . $y . '.png', $data);
	}

	$img = imagecreatefrompng('img/' . $p . '/' . $x . $y . '.png');
	$white = imagecolorallocate($img, 255, 255, 255);
	imagefilledrectangle($img, 0, 75, 300, 300, $white);
	imagepng($img, 'img/' . $p . '/' . $x . $y . '_top.png');

	$img = imagecreatefrompng('img/' . $p . '/' . $x . $y . '.png');
	$white = imagecolorallocate($img, 255, 255, 255);
	imagefilledrectangle($img, 0, 0, 300, 225, $white);
	imagepng($img, 'img/' . $p . '/' . $x . $y . '_bottom.png');

	$img = imagecreatefrompng('img/' . $p . '/' . $x . $y . '.png');
	$white = imagecolorallocate($img, 255, 255, 255);
	imagefilledrectangle($img, 0, 75, 300, 300, $white);
	imagepng($img, 'img/' . $p . '/' . $x . $y . '_left.png');

	$img = imagecreatefrompng('img/' . $p . '/' . $x . $y . '.png');
	$white = imagecolorallocate($img, 255, 255, 255);
	imagefilledrectangle($img, 0, 75, 300, 300, $white);
	imagepng($img, 'img/' . $p . '/' . $x . $y . '_right.png');


	$painting = \App\Painting::find($p);
	$tile = $painting->tiles()
		->where('x', '=', $x)
		->where('y', '=', $y)
		->get()->first();

	$tile->url = '/img/' . $p . '/' . $x . $y . '.png';
	$tile->isLocked = 1;
	$tile->save();
	
});







$app->get('/{id}', function($id) use ($app) {

	$painting = \App\Painting::find($id);
	$median = (int)(((sqrt($painting->tileNumber) + 1) / 2) - 1);
               
     $centerTile = $painting->tiles()
		->where('x', '=', $median)
		->where('y', '=', $median)
		->get()->first(); 
 


	if ($centerTile->isLocked === 0) {
			$centerTile->isLocked = 1;
			$centerTile->save();
			$painting->tilesDone = $painting->tilesDone + 1;
			$painting->save();

		return redirect('/draw/' . $painting->id . '/' . $centerTile->x . '/' . $centerTile->y);
	}
	else {
			for ($i=0; $i < 1; $i++) { 
				# code...
			
 			$randomTile = $painting->tiles()
 			->where('isLocked', '=', 0)
 			->get()
 			->random(1);


			$randomTile->isLocked = 1;
			$randomTile->save();
			$painting->tilesDone = $painting->tilesDone + 1;
			$painting->save();


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

