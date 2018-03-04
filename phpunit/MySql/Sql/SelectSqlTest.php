<?php
namespace phpunit\Gap\Db\MySql\Sql;

use PHPUnit\Framework\TestCase;
use Gap\Db\MySql\SqlBuilder;

class SelectSqlTest extends TestCase
{
    public function testSelectFrom(): void
    {
        $select = (new SqlBuilder())
            ->select('a.*', 'b.col1', 'b.col2', 'b.col3')
            ->from('tableA a', 'tableB b')
            ->limit(10);

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2, b.col3'
            . ' FROM tableA a, tableB b'
            . ' LIMIT 10 OFFSET 0',
            $select->sql()
        );
    }

    public function testWhere(): void
    {
        $select = (new SqlBuilder())
            ->select('a.*', 'b.col1', 'b.col2', 'b.col3')
            ->from('tableA a', 'tableB b')

            ->where()
            ->expect('a.col1')->beStr('v1')
            ->andExpect('a.col2')->beInt(2)
            ->orExpect('b.col1')->greater(3)
            ->orExpect('b.col1')->less(6);

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2, b.col3'
            . ' FROM tableA a, tableB b'
            . ' WHERE a.col1 = :k1'
            . ' AND a.col2 = :k2'
            . ' OR b.col1 > :k3'
            . ' OR b.col1 < :k4'
            . ' LIMIT 10 OFFSET 0',
            $select->sql()
        );
    }

    public function testWhereGroup(): void
    {
        $select = (new SqlBuilder())
            ->select('a.*', 'b.col1', 'b.col2', 'b.col3')
            ->from('tableA a', 'tableB b')

            ->where()
            ->expect('a.col1')->beStr('v1')
            ->andExpect('a.col2')->beInt(2)
            ->andGroup()
            ->expect('b.col1')->greater(3)
            ->orExpect('b.col1')->less(6)
            ->end()
            ->orExpect('a.col3')->lessEqual(100)
            ->andExpect('a.col4')->like('%test%')
            ->orExpect('a.col5')->inInt(1, 2, 3, 4, 5);

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2, b.col3'
            . ' FROM tableA a, tableB b'
            . ' WHERE a.col1 = :k1'
            . ' AND a.col2 = :k2'
            . ' AND (b.col1 > :k3'
            . ' OR b.col1 < :k4)'
            . ' OR a.col3 <= :k5'
            . ' AND a.col4 LIKE :k6'
            . ' OR a.col5 IN (:k7, :k8, :k9, :k10, :k11)'
            . ' LIMIT 10 OFFSET 0',
            $select->sql()
        );
    }
}
