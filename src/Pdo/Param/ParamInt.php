<?php
namespace Gap\Db\Pdo\Param;

class ParamInt extends ParamBase
{
    protected $val;

    public function __construct(int $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_INT;
        parent::__construct();
    }

    public function val(): int
    {
        return $this->val;
    }
}
