<?php
namespace phpunit\Gap\Db\MySql\Ctrl;

class DeleteCtrlTest extends CtrlTestBase
{
    public function testDelete(): void
    {
        $this->initParamIndex();
        $this->cnn->delete('a', 'b', 'c')
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
            'DELETE a, b, c'
            . ' FROM tableA a, tableB b'
            . ' LEFT JOIN tableC c, tableD d'
            . ' ON c.col1 = a.col1 AND d.col2 = b.col2'
            . ' WHERE a.col1 > :k1'
            . ' AND (a.col2 = :k2 OR a.col3 = :k3)'
            . ' AND a.col4 = :k4'
            . ' GROUP BY a.col1 ASC'
            . ' ORDER BY a.col2 DESC'
            . ' LIMIT 28 OFFSET 3',
            $this->cnn->sql()
        );
    }
}
