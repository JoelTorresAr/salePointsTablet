<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MozoController extends Controller
{
    public function login(Request $requeste){
        $pin = $requeste->input('pin');
        User::where('pin', '=', $pin)->firstOrFail();
    }
}
