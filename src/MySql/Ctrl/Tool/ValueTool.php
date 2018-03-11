<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Ctrl\InsertCtrl;
use Gap\Db\MySql\Sql\Part\ValuePart;

use Gap\Db\Pdo\Statement;

class ValueTool
{
    protected $insertCtrl;
    protected $insertSql;
    protected $valuePart;

    public function __construct(InsertCtrl $insertCtrl, ValuePart $valuePart)
    {
        $this->insertCtrl = $insertCtrl;
        $this->insertSql = $insertCtrl->getInsertSql();
        $this->valuePart = $valuePart;
    }

    public function addStr(string $val): self
    {
        $this->valuePart->add($this->insertSql->paramStr($val));
        return $this;
    }

    public function addInt(int $val): self
    {
        $this->valuePart->add($this->insertSql->paramInt($val));
        return $this;
    }

    public function addBool(bool $val): self
    {
        $this->valuePart->add($this->insertSql->paramBool($val));
        return $this;
    }

    public function addDateTime(\DateTime $val): self
    {
        $this->valuePart->add($this->insertSql->paramDatetime($val));
        return $this;
    }

    public function value(): ValueTool
    {
        return $this->insertCtrl->value();
    }

    public function execute(): Statement
    {
        return $this->insertCtrl->execute();
    }
}
