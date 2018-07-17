<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 17/07/2018
 * Time: 11:13 PM
 */

namespace Tests;


use PHPUnit\Framework\TestCase;

class AnyTest extends TestCase
{

    public function testAny()
    {
        $this->assertEquals('true', 1);
    }
}