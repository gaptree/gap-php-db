<?php
namespace Gap\Db\MySql\Sql\Part;

class WherePart extends PartBase
{
    protected $partArr = [];
    protected $pre = '';
    protected $isPacked = false;

    public function __construct(string $pre = '')
    {
        $this->pre = $pre; // '', 'AND', 'OR'
    }

    public function pack(): self
    {
        $this->isPacked = true;
        return $this;
    }

    public function partSql(): string
    {
        $pre = $this->pre ? $this->pre . ' ' : '';
        $partSql = implode(' ', $this->partArr);

        if ($this->isPacked) {
            return $pre . '(' . $partSql . ')';
        }

        return $pre . $partSql;
    }

    public function getExpectPart(string $field, string $pre = ''): ExpectPart
    {
        $expectPart = new ExpectPart($field, $pre);
        $this->partArr[] = $expectPart;
        return $expectPart;
    }

    public function getGroupPart(string $pre = ''): WherePart
    {
        $groupPart = new WherePart($pre);
        $this->partArr[] = $groupPart;
        return $groupPart;
    }
}
