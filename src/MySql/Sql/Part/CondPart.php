<?php
namespace Gap\Db\MySql\Sql\Part;

class CondPart extends PartBase
{
    protected $partArr = [];
    protected $pre = '';
    protected $isPacked = false;

    public function pre(string $pre): self
    {
        $this->pre = $pre; // '', 'AND', 'OR'
        return $this;
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

    public function expect(string $field, string $pre = ''): ExpectPart
    {
        $expectPart = new ExpectPart($this, $field, $pre);
        $this->partArr[] = $expectPart;
        return $expectPart;
    }

    public function andExpect(string $field): ExpectPart
    {
        return $this->expect($field, 'AND');
    }

    public function orExpect(string $field): ExpectPart
    {
        return $this->expect($field, 'OR');
    }

    public function group(CondPart $group): self
    {
        $group->pack();
        $this->partArr[] = $group;
        return $this;
    }

    public function andGroup(CondPart $group): self
    {
        return $this->group($group->pre('AND'));
    }

    public function orGroup(CondPart $group): self
    {
        return $this->group($group->pre('OR'));
    }
}
