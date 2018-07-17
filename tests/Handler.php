<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 18/07/2018
 * Time: 12:20 AM
 */

namespace Tests;


use Lvinkim\MongoOplog\HandlerInterface;

class Handler implements HandlerInterface
{
    public function handle($document): bool
    {
        var_dump($document);
        return true;
    }
}