<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\SqlBuilder\ManipulateSqlBuilder;
use Gap\Db\MySql\Sql\Part\TablePart;

class TableTool extends ToolBase
{
    protected $msb;
    protected $cnn;
    protected $tablePart;

    public function __construct(
        ManipulateSqlBuilder $msb,
        Cnn $cnn,
        TablePart $tablePart
    ) {
        $this->msb = $msb;
        $this->cnn = $cnn;
        $this->tablePart = $tablePart;
    }

    public function end(): ManipulateSqlBuilder
    {
        return $this->msb;
    }

    public function join(string ...$tableArr): JoinTool
    {
        return new JoinTool(
            $this,
            $this->cnn,
            $this->tablePart->join(...$tableArr)
        );
    }

    public function leftJoin(string ...$tableArr): JoinTool
    {
        return $this->join(...$tableArr)->pre('LEFT');
    }

    public function rightJoin(string ...$tableArr): JoinTool
    {
        return $this->join(...$tableArr)->pre('RIGHT');
    }

    public function innerJoin(string ...$tableArr): JoinTool
    {
        return $this->join(...$tableArr)->pre('INNER');
    }

    public function outerJoin(string ...$tableArr): JoinTool
    {
        return $this->join(...$tableArr)->pre('OUTER');
    }
}
