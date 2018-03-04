<?php
namespace Gap\Db\MySql\Sql\Select;

class Where extends Base
{
    protected $partArr = [];
    protected $pre = '';
    protected $isPacked = false;

    public function setPre(string $pre): void
    {
        $this->pre = $pre;
    }

    public function pack(): void
    {
        $this->isPacked = true;
    }

    public function unPack(): void
    {
        $this->isPacked = false;
    }

    public function expect(string $field, string $pre = ''): WhereCond
    {
        $cond = new WhereCond($this, $field, $pre);
        $this->partArr[] = $cond;
        return $cond;
    }

    public function andExpect(string $field): WhereCond
    {
        return $this->expect($field, 'AND');
    }

    public function orExpect(string $field): WhereCond
    {
        return $this->expect($field, 'OR');
    }

    public function group(string $pre = ''): Where
    {
        $group = new Where($this->selectSql);
        $group->setPre($pre);
        $group->pack();

        $this->partArr[] = $group;
        return $group;
    }

    public function andGroup(): Where
    {
        return $this->group('AND');
    }

    public function orGroup(): Where
    {
        return $this->group('OR');
    }

    public function partSql(): string
    {
        return implode(
            ' ',
            array_map(
                function ($item) {
                    return $item->partSql();
                },
                $this->partArr
            )
        );
    }
}
