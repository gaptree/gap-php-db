<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\SqlBuilder\ManipulateSqlBuilder;
use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\Sql\Part\CondPart;

class WhereCondTool extends CondTool
{
    protected $msb;

    public function __construct(ManipulateSqlBuilder $msb, Cnn $cnn, CondPart $condPart)
    {
        $this->msb = $msb;
        $this->cnn = $cnn;
        $this->condPart = $condPart;
    }

    public function end(): ManipulateSqlBuilder
    {
        return $this->msb;
    }
}
