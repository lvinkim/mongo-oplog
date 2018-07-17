<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 18/07/2018
 * Time: 12:15 AM
 */

namespace Tests;


use Lvinkim\MongoOplog\Tail;
use MongoDB\Driver\Manager;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{
    /** @var Tail */
    private $tail;

    public function setUp()
    {
        $serverDns = 'mongodb://docker.for.mac.localhost';
        $manager = new Manager($serverDns);
        $this->tail = new Tail($manager);
    }

    public function testHandle()
    {
        $handler = new Handler();
        $this->tail->pushHandler($handler);

        $this->tail->run();
    }
}