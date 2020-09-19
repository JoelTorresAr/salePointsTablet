<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public $timestamps = false;

    /**
     * The users that belong to the shop.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    /**
     * Get the cash boxes for the shop
     */
    public function cashBoxes()
    {
        return $this->hasMany('App\Models\CashBox');
    }

    /**
     * Get all of the floors for the shop.
     */
    public function floors()
    {
        return $this->hasManyThrough('App\Models\Floor', 'App\Models\CashBox');
    }

    /**
     * Get all of the menus fot the Shop
     */
    public function menus(){
        return $this->hasMany('App\Models\Menu');
    }

    /**
     * Get all of the menu families for the shop.
     */
    public function menuFamilies()
    {
        return $this->hasManyThrough('App\Models\MenuFamily', 'App\Models\Menu');
    }
}
