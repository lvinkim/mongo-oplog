# mongo-oplog
操作 mongodb 的 oplog

### 安装
```
$ composer require lvinkim/mongo-oplog
```

### 用法
```php

use Lvinkim\MongoOplog\Tail;
use MongoDB\Driver\Manager;

// 实现 HandlerInterface 接口

class Handler implements HandlerInterface
{
    public function handle($document): bool
    {
        var_dump($document);
        return true;
    }
}

// 运行 

$serverDns = 'mongodb://docker.for.mac.localhost';
$manager = new Manager($serverDns);
$tail = new Tail($manager);

$handler = new Handler();
$tail->pushHandler($handler);

$filter = [
    'ts' => ['$gte' => new \MongoDB\BSON\Timestamp(1, time())],
    'ns' => 'test.user',
];

$tail->run($filter);

```