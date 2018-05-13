<?php
namespace Gap\Db;

// http://php.net/manual/en/class.iterator.php

abstract class Collection implements \Iterator, \JsonSerializable
{
    public function toArray(): array
    {
        return iterator_to_array($this);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    abstract public function current();
    abstract public function key();
    abstract public function next(): void;
    abstract public function rewind(): void;
    abstract public function valid(): bool;

    abstract public function limit(int $limit);
    abstract public function offset(int $offset);
}
