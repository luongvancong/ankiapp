<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssetTest extends TestCase
{
    public function test_add_style()
    {
        $asset = new App\Helper\Asset();
        $asset->setVersion('1.1');
        $asset->addStyle('/css/style.css');
        $asset->addScript('/js/style.js');
        $this->assertInternalType('string', $asset->render());
    }
}
