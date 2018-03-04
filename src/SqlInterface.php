<?php
namespace Gap\Db;

interface SqlInterface
{
    public function buildSql(): string;
}
