<?php

namespace ecommpay\tests\blocks;

use ecommpay\gate\blocks\General;
use PHPUnit\Framework\TestCase;

class GeneralTest extends TestCase
{

    public function testContruct()
    {
        $class = new General([
            'project_id' => 1,
        ]);

        self::assertEquals(1, $class->project_id);
    }

    public function testValidateProjectId()
    {
        self::assertCount(1, (new General(['project_id' => 1]))->validate());
    }
}
