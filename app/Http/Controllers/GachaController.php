<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gacha;
use Illuminate\Support\Facades\Input;

class GachaController extends Controller
{
    public function index()
    {
        $strMessage = Input::get('m');
        $lstGachas = Gacha::all();

        return view('gacha.index')
            ->with('message', $strMessage)
            ->with('gachas', $lstGachas);
    }

    public function store()
    {
        $strName = Input::get('name', '');
        $intWeight = (int)Input::get('weight', 0);
        $intRarity = (int)Input::get('rarity', 1);
        $boolIsActive = (boolean)Input::get('is_active', true);

        $strMessage = Gacha::store($strName, $intWeight, $intRarity, $boolIsActive);
        return redirect('gacha?m=' . $strMessage);
    }

    public function delete()
    {
        $intGachaId = (int)Input::get('gacha_id');

        if ($intGachaId <= 0) {
            $strMessage = "Invaid Gacha ID";
            return redirect('gacha?m=' . $strMessage);
        }
        $objGacha = Gacha::find($intGachaId);

        $strMessage = "Delete Successed";
        if (!$objGacha || $objGacha->delete()) {
            $strMessage = "Delete Failed";
            return redirect('gacha?m=' . $strMessage);
        }

        return redirect('gacha?m=' . $strMessage);
    }

    public function update()
    {
        $intGachaId = (int)Input::get('gacha_id');
        if ($intGachaId <= 0) {
            $strMessage = "Invaid Gacha ID";
            return redirect('gacha?m=' . $strMessage);
        }

        $strName = Input::get('name', '');
        $intWeight = (int)Input::get('weight', 0);
        $intRarity = (int)Input::get('rarity', 1);
        $boolIsActive = (boolean)Input::get('is_active', true);

        $strMessage = Gacha::store($strName, $intWeight, $intRarity, $boolIsActive, $intGachaId);
        return redirect('gacha?m=' . $strMessage);
    }
}
