<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{

    public $timestamps = false;

    /**
     * Get the shop that owns the cash box.
     */
    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    /**
     * Get the floors for the cash box
     */
    public function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }
}
