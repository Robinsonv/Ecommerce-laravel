<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function presetPrice(){
        return money_format('$%i', $this->price / 100);
    }

    public function scopeMightAlsoLike($query, $num){
        return $query->inRandomOrder()->take($num);
    }
}
