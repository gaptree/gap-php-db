<?php
namespace Gap\Db\MySql\Sql\Select;

use Gap\Db\MySql\Sql\Util\Cond;

class WhereCondBase
{
    protected $where;
    protected $cond;

    public function __construct(Where $where, string $field, string $pre = '')
    {
        $this->where = $where;
        $this->cond = new Cond($field, $pre);
    }

    public function partSql(): string
    {
        return $this->cond->partSql();
    }

    public function beStr(string $val): Where
    {
        $this->cond->beStr($val);
        return $this->where;
    }

    public function beInt(int $val): Where
    {
        $this->cond->beInt($val);
        return $this->where;
    }

    public function like(string $val): Where
    {
        $this->cond->like($val);
        return $this->where;
    }
}
