<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerGachaController extends Controller
{
    public function index() 
    {
        return view('player-gacha.index');
    }

    public function gacha()
    {
        return redirect('player-gacha/result');
    }

    public function result()
    {
        return view('player-gacha.result');
    }
}
