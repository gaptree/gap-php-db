<?php
namespace Gap\Db\MySql\Param;

class ParamBool extends ParamBase
{
    protected $val;

    public function __construct(bool $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_BOOL;
        parent::__construct();
    }

    public function val(): bool
    {
        return $this->val;
    }
}