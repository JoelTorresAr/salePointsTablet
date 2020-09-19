<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public $timestamps = false;

    /**
     * Get the users for the business.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
    /**
     * Get the shops for the business
     */
    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }
}
