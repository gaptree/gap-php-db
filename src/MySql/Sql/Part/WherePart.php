<?php
namespace Gap\Db\MySql\Sql\Part;

class WherePart extends PartBase
{
    protected $partArr = [];
    protected $pre = '';
    protected $isPacked = false;
    protected $parent = null;

    public function partSql(): string
    {
        if ($this->partArr) {
            return implode(' ', $this->partArr);
        }

        return '';
    }

    public function getExpectPart(string $field, string $pre = ''): ExpectPart
    {
        $expectPart = new ExpectPart($field, $pre);
        $this->partArr[] = $expectPart;
        return $expectPart;
    }
}
