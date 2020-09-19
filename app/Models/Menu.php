<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;

    /**
     * Get the menu family that owns the menu
     */
    public function menu(){
        return $this->belongsTo('App\Models\MenuFamily');
    }

    /**
     * Get the shop that owns the menu
     */
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
}
