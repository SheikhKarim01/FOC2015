<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Painting extends Model {
    protected $table = 'paintings';

    public function tiles()
    {
        return $this->hasMany('App\Tile');
    }

}