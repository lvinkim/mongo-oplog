<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 18/07/2018
 * Time: 12:29 AM
 */

use Lvinkim\MongoOplog\Tail;
use MongoDB\Driver\Manager;

require dirname(__DIR__) . '/vendor/autoload.php';

$serverDns = 'mongodb://docker.for.mac.localhost';
$manager = new Manager($serverDns);
$tail = new Tail($manager);

$handler = new \Tests\Handler();
$tail->pushHandler($handler);

$filter = [
    'ts' => ['$gte' => new \MongoDB\BSON\Timestamp(1, time())],
    'ns' => 'test.user',
];

$tail->run($filter);

