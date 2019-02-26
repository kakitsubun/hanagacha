<?php

namespace Tests\Gacha;

use App\Gacha;
use App\PlayerGacha;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GachaTest extends TestCase
{
    use DatabaseTransactions;

    public function testGachaTest()
    {
        // Fake Gacha Data
        factory(Gacha::class, 100)->create();

        // Player Gacha
        $strPlayerName = str_random(10);
        $objPlayerGacha = new PlayerGacha();
        $result = $objPlayerGacha->gacha($strPlayerName);

        // If Gacha Success
        $this->assertEquals($result, true);

        // Check Gacha Result
        $objGacha = Gacha::find($objPlayerGacha->gacha_id);
        $this->assertInstanceOf(Gacha::class, $objGacha);
        $this->assertEquals($objGacha->is_active, true);
    }
}
