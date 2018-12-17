<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GachaController extends Controller
{
    public function index()
    {
        return view('gacha.index');
    }

    public function store()
    {
        return redirect('gacha/index');
    }

    public function delete()
    {
        return redirect('gacha/index');
    }

    public function update()
    {
        return redirect('gacha/index');
    }
}
