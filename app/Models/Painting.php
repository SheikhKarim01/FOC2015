<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Painting extends Model {
    protected $table = 'painting';

    public function tiles()
    {
        return $this->hasMany('Tile');
    }

}