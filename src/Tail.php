<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 17/07/2018
 * Time: 11:46 PM
 */

namespace Lvinkim\MongoOplog;


use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

class Tail
{
    /** @var Manager */
    private $manager;

    /**
     * The handler stack
     *
     * @var HandlerInterface[]
     */
    protected $handlers;


    /**
     * Tail constructor.
     * @param Manager $manager
     * @param HandlerInterface[] $handlers
     */
    public function __construct(Manager $manager, array $handlers = [])
    {
        $this->manager = $manager;
        $this->handlers = $handlers;
    }

    public function run(array $filter = [])
    {
        $queryOptions = ['tailable' => true, 'awaitData' => true,];
        $query = new Query($filter, $queryOptions);

        try {
            $namespace = 'local.oplog.rs';
            $cursor = $this->manager->executeQuery($namespace, $query);
        } catch (Exception $exception) {

        }

        $iterator = new \IteratorIterator($cursor);

        $iterator->rewind();

        while (true) {
            if ($iterator->valid()) {
                $document = $iterator->current();

                reset($this->handlers);
                while ($handler = current($this->handlers)) {
                    if (false === $handler->handle($document)) {
                        break;
                    }
                    next($this->handlers);
                }
            }
            $iterator->next();
        }
    }

    /**
     * Pushes a handler on to the stack.
     *
     * @param  HandlerInterface $handler
     * @return $this
     */
    public function pushHandler(HandlerInterface $handler)
    {
        array_unshift($this->handlers, $handler);

        return $this;
    }

}