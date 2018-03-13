<?php
namespace Gap\Db\MySql\SqlBuilder\Select;

use Gap\Db\Collection;

trait FetchTrait
{
    public function fetch(string $class)
    {
        if (empty($class)) {
            throw new \Exception("fetch empty class");
        }
    }

    public function fetchAssoc(): array
    {
    }

    public function list(string $class): Collection
    {
        if (empty($class)) {
            throw new \Exception("fetch empty class");
        }
    }

    public function listAssoc()
    {
    }
}
