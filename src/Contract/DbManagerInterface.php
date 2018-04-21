<?php
namespace Gap\Db\Contract;

interface DbManagerInterface
{
    public function connect(string $name): CnnInterface;
}
