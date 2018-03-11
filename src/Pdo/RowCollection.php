<?php
namespace Gap\Db\Pdo;

class RowCollection implements \Gap\Db\CollectionInterface
{
    protected $stmt;
    protected $class;

    protected $current;

    public function __construct(Statement $stmt, string $class)
    {
        $this->stmt = $stmt;
        $this->class = $class;
    }

    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        throw new \Exception('no key');
    }

    public function next()
    {
        $this->current = $this->stmt->fetch($this->class);
    }

    public function rewind()
    {
        $this->current = $this->stmt->fetch($this->class);
    }

    public function valid()
    {
        return $this->current ? true : false;
    }
}
