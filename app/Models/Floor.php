<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    public $timestamps = false;
    protected $hidden = ['laravel_through_key'];
    /**
     * Get the cash box that owns the floor.
     */
    public function cashBox(){
       return $this->belongsTo('App\Models\CashBox');
    }

    /**
     * Get the tables for the Floor
     */
     public function tables(){
        return $this->hasMany('App\Models\Table');
     }
    
}
