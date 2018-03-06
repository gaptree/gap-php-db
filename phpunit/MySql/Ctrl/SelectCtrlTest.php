<?php
namespace phpunit\Gap\Db\MySql\Ctrl;

use PHPUnit\Framework\TestCase;
use Gap\Db\MySql\SqlBuilder;

class SelectCtrlTest extends TestCase
{
    public function testFrom(): void
    {
        $sqlCtrl = (new SqlBuilder())->select('a.*', 'b.col1', 'b.col2')
            ->from('tableA a', 'tableB b');

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b',
            $sqlCtrl->sql()
        );
    }

    public function testJoin(): void
    {
        $sqlCtrl = (new SqlBuilder())->select('a.*', 'b.col1', 'b.col2')
            ->from('tableA a', 'tableB b')
            ->leftJoin('tableC c', 'tableD d')
            ->onCond()
                ->expect('c.col1')->beExpr('a.col1')
                ->andExpect('d.col2')->beExpr('b.col2')
            ->where()
                ->expect('a.col1')->greater(9);

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' LEFT JOIN tableC c, tableD d'
            . ' ON c.col1 = a.col1 AND d.col2 = b.col2'
            . ' WHERE a.col1 > :k1',
            $sqlCtrl->sql()
        );
    }
}
