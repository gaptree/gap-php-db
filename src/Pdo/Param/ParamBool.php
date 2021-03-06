<?php
namespace Gap\Db\Pdo\Param;

class ParamBool extends ParamBase
{
    protected $val;

    public function __construct(bool $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_BOOL;
        $this->initKey();
    }

    public function val(): bool
    {
        return $this->val;
    }
}
