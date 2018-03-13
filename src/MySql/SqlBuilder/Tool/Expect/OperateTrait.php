<?php
namespace Gap\Db\MySql\SqlBuilder\Tool\Expect;

trait OperateTrait
{
    public function equal(): self
    {
        $this->operate = '=';
        return $this;
    }

    public function less(): self
    {
        $this->operate = '<';
        return $this;
    }

    public function lessEqual(): self
    {
        $this->operate = '<=';
        return $this;
    }

    public function greater(): self
    {
        $this->operate = '>';
        return $this;
    }

    public function greaterEqual(): self
    {
        $this->operate = '>=';
        return $this;
    }

    public function like(): self
    {
        $this->operate = 'LIKE';
        return $this;
    }
}
