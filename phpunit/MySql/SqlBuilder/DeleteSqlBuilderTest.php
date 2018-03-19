<?php
namespace phpunit\Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Cnn;

class DeleteSqlBuilderTest extends SqlBuilderTestBase
{
    public function testDelete(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $dsb = $cnn->dsb()
            ->delete('a', 'b', 'c')
            ->from('tableA a', 'tableB b')
                ->leftJoin('tableC c', 'tableD d')
                ->onCond()
                    ->expect('c.col1')->equal()->expr('a.col1')
                    ->andExpect('d.col2')->equal()->expr('b.col2')
                ->endJoin()
            ->end()
            ->where()
                ->expect('a.col1')->greater()->int(9)
                ->andGroup()
                    ->expect('a.col2')->equal()->str('v2')
                    ->orExpect('a.col3')->equal()->int(3)
                ->endGroup()
                ->andExpect('a.col4')->equal()->dateTime(new \DateTime())
            ->end()
            ->limit(28)
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
            . ' LIMIT 28',
            $dsb->sql()
        );
    }
}
