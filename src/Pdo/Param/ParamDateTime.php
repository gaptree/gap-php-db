<?php
namespace Gap\Db\Pdo\Param;

class ParamDateTime extends ParamBase
{
    protected $val;

    public function __construct(\DateTime $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_STR;
        $this->initKey();
    }

    public function val(): string
    {
        return $this->val->format('Y-m-d H:i:s.u');
    }
}
