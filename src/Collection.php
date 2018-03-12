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
}
