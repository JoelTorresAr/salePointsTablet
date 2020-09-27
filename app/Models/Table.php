<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public $timestamps = false;

    /**
     * Get the floor that owns the table
     */
    public function floor(){
        return $this->belongsTo('App\Models\Floor');
    }

    /**
     * Get the command that owns the table
     */
    public function command(){
        return $this->belongsTo('App\Models\Command');
    }
}
