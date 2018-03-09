<?php
namespace Gap\Db\Pdo\Param;

abstract class ParamBase
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
