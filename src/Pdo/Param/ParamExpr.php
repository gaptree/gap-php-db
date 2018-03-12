<?php
namespace Gap\Db\Pdo\Param;

class ParamExpr extends ParamBase
{
    protected $val;

    public function __construct(string $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_STR;
    }

    public function val(): string
    {
        return $this->val;
    }

    public function key(): string
    {
        return $this->val;
    }
}
