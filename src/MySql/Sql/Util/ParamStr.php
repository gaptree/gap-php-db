<?php
namespace Gap\Db\MySql\Sql\Util;

class ParamStr extends Param
{
    protected $val;

    public function __construct(string $val)
    {
        $this->val = $val;
        $this->type = \PDO::PARAM_STR;
        parent::__construct();
    }

    public function val(): string
    {
        return $this->val;
    }
}
