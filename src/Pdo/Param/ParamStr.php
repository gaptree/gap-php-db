<?php
namespace Gap\Db\Pdo\Param;

class ParamStr extends ParamBase
{
    protected $val;

    public function __construct(string $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_STR;
        $this->initKey();
    }

    public function val(): string
    {
        return $this->val;
    }
}
