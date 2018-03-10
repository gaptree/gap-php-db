<?php
namespace Gap\Db;

interface DbManagerInterface
{
    public function connect(string $name);
}
