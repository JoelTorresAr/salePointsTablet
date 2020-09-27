<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    public $timestamps = false;

    /**
     * Get the tables for the command
     */
    public function tables()
    {
        return $this->hasMany('App\Models\Table');
    }
}
