<?php
namespace Gap\Db\MySql\Sql\Util;

// http://php.net/manual/en/pdo.constants.php

abstract class Param
{
    protected static $index = 1;

    protected $type;
    protected $key;

    public function __construct()
    {
        $this->key = ':k' . strval(self::$index++);
    }

    public function key(): string
    {
        return $this->key;
    }

    public function type(): int
    {
        return $this->type;
    }

    abstract public function val();
}
