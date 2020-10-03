<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandMenu extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'command_menu';
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'print_status',
        'increment',
    ];
}
