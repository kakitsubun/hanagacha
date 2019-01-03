<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;
use Response, Input, Log;

class Gacha extends Model
{
    public static function store($strName, $intWeight, $intRarity, $boolIsActive, $intGachaId = 0) {
        $objGacha = null;
        if ($intGachaId != 0) {
            $objGacha = self::find($intGachaId);
            if (!$objGacha || empty($objGacha)) {
                return "Gacha Is Not Exsit";
            }
        } else {
            $objGacha = new Gacha();
        }

        $objGacha->name = $strName;
        $objGacha->weight = (int)$intWeight;
        $objGacha->rarity = (int)$intRarity;
        $objGacha->is_active = (boolean)$boolIsActive;

        $strMessage = "";
        DB::beginTransaction();
        try {
            if ($objGacha->save()) {
                $strMessage = "Add/Update Successed";
            } else {
                $strMessage = "Add/Update Failed";
                throw new Exception();
            }
            DB::commit(); 
        } catch(Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }

        return $strMessage;
    }

    // public static function delete($intGachaId) {

    // }
}
