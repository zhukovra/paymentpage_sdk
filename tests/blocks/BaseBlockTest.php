<?php

namespace ecommpay\tests\blocks;

use ecommpay\gate\blocks\BaseBlock;
use PHPUnit\Framework\TestCase;

class BaseBlockTest extends TestCase
{

    public function testBlocks()
    {
        self::assertCount(2, BaseBlock::blocks());
    }
}
