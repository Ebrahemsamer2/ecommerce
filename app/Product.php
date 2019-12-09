<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'quantity', 'price'];


    // Relationships functions
    
    public function photo() {
        return $this->morphOne('App\Photo', 'photoable');
    }

    public function category() {
    	return $this->belongsTo('App\Category');
    }
    
}
