<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSupply extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_supply';
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'increment',
    ];
}
