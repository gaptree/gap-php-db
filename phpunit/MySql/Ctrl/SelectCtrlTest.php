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
                ->expect('a.col1')->greater(9)
                ->andGroup()
                    ->expect('a.col2')->beStr('v2')
                    ->orExpect('a.col3')->beInt(3)
                ->end()
                ->andExpect('a.col4')->beDateTime(new \DateTime())
                ->limit(28)->offset(3)
                ->ascGroupBy('a.col1')
                ->descOrderBy('a.col2');

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' LEFT JOIN tableC c, tableD d'
            . ' ON c.col1 = a.col1 AND d.col2 = b.col2'
            . ' WHERE a.col1 > :k1'
            . ' AND (a.col2 = :k2 OR a.col3 = :k3)'
            . ' AND a.col4 = :k4'
            . ' GROUP BY a.col1 ASC'
            . ' ORDER BY a.col2 DESC'
            . ' LIMIT 28 OFFSET 3',
            $sqlCtrl->sql()
        );
    }
}
