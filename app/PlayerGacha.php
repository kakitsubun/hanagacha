<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerGacha extends Model
{
    public function gacha(string $strPlayerName)
    {
        $objGacha = $this->gachaExec();

        if (!empty($objGacha)) {
            $this->gacha_id = $objGacha->id;
            $this->player_name = $strPlayerName;
            return $this->save();
        }

        return false;
    }

    private function gachaExec()
    {
        $lstGachas = Gacha::where('is_active', true)->get();
        $intTotalWeight = Gacha::where('is_active', true)->sum('weight');

        if (empty($lstGachas) || $intTotalWeight <= 0) {
            throw new \Exception("No ");
        }

        $intRandom = mt_rand(0, $intTotalWeight);

        $intSumWeight = 0;
        foreach ($lstGachas as $objGacha) {
            $intSumWeight += $objGacha->weight;
            if ($intSumWeight >= $intRandom) {
                return $objGacha;
            }
        }

        return null;
    }
}
