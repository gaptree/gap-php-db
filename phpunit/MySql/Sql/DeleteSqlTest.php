<?php
namespace phpunit\Gap\Db\MySql\Sql;

class DeleteSqlTest extends SqlTestBase
{
    public function testDelete(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();

        $delete = $cnn->delete('a', 'b', 'c')
            ->from(
                $cnn->table('tableA a', 'tableB b')
                    ->leftJoin('tableC c', 'tableD d')
                    ->onCond(
                        $cnn->cond()
                            ->expect('c.col1')->equal($cnn->expr('a.col1'))
                            ->andExpect('d.col2')->equal($cnn->expr('b.col2'))
                    )
            )
            ->where(
                $cnn->cond()
                    ->expect('a.col1')->greater($cnn->int(9))
                    ->andGroup(
                        $cnn->cond()
                            ->expect('a.col2')->equal($cnn->str('v2'))
                            ->orExpect('a.col3')->equal($cnn->int(3))
                    )
                    ->andExpect('a.col4')->equal($cnn->dateTime(new \DateTime()))
            )
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
            $delete->sql()
        );
    }
}
