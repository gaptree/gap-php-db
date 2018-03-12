<?php
namespace phpunit\Gap\Db\MySql\Sql;

class UpdateSqlTest extends SqlTestBase
{
    public function testSimple(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();

        $update = $cnn->update(
            $cnn->table('tableA a', 'tableB b')
        )
        ->set('a.col1', $cnn->expr('b.col1'))
        ->set('a.col2', $cnn->str('val2'))
        ->set('a.col3', $cnn->int(3));

        $this->assertEquals(
            'UPDATE tableA a, tableB b'
            . ' SET a.col1 = b.col1, a.col2 = :k1, a.col3 = :k2',
            $update->sql()
        );
    }

    public function testJoin(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();

        $update = $cnn->update(
            $cnn->table('tableA a', 'tableB b')
                ->leftJoin('tableC c', 'tableD d')
                ->onCond(
                    $cnn->cond()
                        ->expect('c.col1')->equal($cnn->expr('a.col1'))
                        ->andExpect('d.col2')->equal($cnn->expr('b.col2'))
                )
        )
        ->set('a.col1', $cnn->expr('b.col1'))
        ->set('a.col2', $cnn->str('val2'))
        ->set('a.col3', $cnn->int(3))
        ->where(
            $cnn->cond()
                ->expect('a.col1')->equal($cnn->str('v1'))
        );

        $this->assertEquals(
            'UPDATE tableA a, tableB b'
            . ' LEFT JOIN tableC c, tableD d ON c.col1 = a.col1 AND d.col2 = b.col2'
            . ' SET a.col1 = b.col1, a.col2 = :k1, a.col3 = :k2'
            . ' WHERE a.col1 = :k3',
            $update->sql()
        );
    }
}
