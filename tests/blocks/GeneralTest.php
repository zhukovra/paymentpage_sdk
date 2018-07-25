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
        $violations = (new General(['project_id' => 100]))->validate(['project_id']);
        self::assertCount(0, $violations);
    }
}
