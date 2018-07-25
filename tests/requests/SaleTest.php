<?php

namespace ecommpay\tests\requests;

use ecommpay\gate\blocks\General;
use ecommpay\gate\requests\Sale;
use PHPUnit\Framework\TestCase;

class SaleTest extends TestCase
{

    public function testConstructBlocks()
    {
        $block = new General(['project_id' => 1]);
        $request = new Sale([$block]);
        self::assertEquals([$block], $request->getBlocks());
    }

    public function testConstructValues()
    {
        $block = new General(['project_id' => 1]);
        $request = new Sale(['project_id' => 1]);
        self::assertEquals([$block], $request->getBlocks());
    }
}
