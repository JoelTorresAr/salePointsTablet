<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    public $timestamps = false;
    /**
     * Get the cash box that owns the floor.
     */
    public function cashBox(){
        $this->belongsTo('App\Models\CashBox');
    }
    
}
