<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 18/07/2018
 * Time: 12:10 AM
 */

namespace Lvinkim\MongoOplog;


interface HandlerInterface
{
    public function handle($document): bool;
}