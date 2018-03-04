<?php
namespace Gap\Db\MySql\Sql\Select;

use Gap\Db\MySql\Sql\Util\Cond;

class WhereCond extends WhereCondBase
{
    public function greater(int $val): Where
    {
        $this->cond->greater($val);
        return $this->where;
    }

    public function greaterEqual(int $val): Where
    {
        $this->cond->greaterEqual($val);
        return $this->where;
    }

    public function less(int $val): Where
    {
        $this->cond->less($val);
        return $this->where;
    }

    public function lessEqual(int $val): Where
    {
        $this->cond->lessEqual($val);
        return $this->where;
    }

    public function inInt(int ...$valArr): Where
    {
        $this->cond->inInt(...$valArr);
        return $this->where;
    }

    public function inStr(string ...$valArr): Where
    {
        $this->cond->inStr(...$valArr);
        return $this->where;
    }
}
