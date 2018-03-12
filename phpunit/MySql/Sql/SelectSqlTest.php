<?php
namespace phpunit\Gap\Db\MySql\Sql;

use Gap\Db\MySql\Cnn;

class SelectSqlTest extends SqlTestBase
{
    public function testSimple(): void
    {
        $this->initParamIndex();

        $cnn = $this->getCnn();
        $select = $cnn->select('a.*', 'b.col1', 'b.col2')
            ->from(
                $cnn->table('tableA a', 'tableB b')
            )->where(
                $cnn->cond()
                    ->expect('a.col1')->equal($cnn->str('v1'))
            );

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' WHERE a.col1 = :k1'
            . ' LIMIT 10 OFFSET 0',
            $select->sql()
        );
    }

    public function testLike(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $select = $cnn->select('a.*', 'b.col1', 'b.col2')
            ->from(
                $cnn->table('tableA a', 'tableB b')
            )->where(
                $cnn->cond()
                    ->expect('a.col1')->like($cnn->str('%hello%'))
            );

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' WHERE a.col1 LIKE :k1'
            . ' LIMIT 10 OFFSET 0',
            $select->sql()
        );
    }

    public function testJoin(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $select = $cnn->select('a.*', 'b.col1', 'b.col2')
            ->from(
                $cnn->table('tableA a', 'tableB b')
                    ->leftJoin('tableC c', 'tableD d')
                    ->onCond(
                        $cnn->cond()
                            ->expect('c.col1')->equal($cnn->expr('a.col1'))
                            ->andExpect('d.col2')->equal($cnn->expr('b.col2'))
                    )
            )->where(
                $cnn->cond()
                    ->expect('a.col1')->greater($cnn->int(9))
                    ->andGroup(
                        $cnn->cond()
                            ->expect('a.col2')->equal($cnn->str('v2'))
                            ->orExpect('a.col3')->equal($cnn->int(3))
                    )
                    ->andExpect('a.col4')->equal($cnn->dateTime(new \DateTime()))
            )
            ->ascGroupBy('a.col1')
            ->descOrderBy('a.col2')
            ->limit(28)->offset(3);

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
            $select->sql()
        );
    }

    public function testFetch(): void
    {
        $pdo = $this->createMock('PDO');
        $stmt = $this->createMock('PDOStatement');
        $stmt->method('execute')->will($this->returnValue(true));
        $stmt->method('fetch')->will($this->returnValue([
            'name' => 'apple', 'color'=> 'green',
        ]));
        $pdo->method('prepare')->will($this->returnValue($stmt));

        $serverId = 'xdfsa';
        $cnn = new Cnn($pdo, $serverId);

        $fruit = $cnn->select('*')
            ->from($cnn->table('fruit'))
            ->fetch(FruitDto::class);

        $this->assertEquals(
            new FruitDto([
                'name' => 'apple', 'color'=> 'green',
            ]),
            $fruit
        );
    }

    public function testListAssoc(): void
    {
        $pdo = $this->createMock('PDO');
        $stmt = $this->createMock('PDOStatement');
        $stmt->method('execute')->will($this->returnValue(true));
        $stmt->method('fetchAll')->will($this->returnValue([
            ['name' => 'apple', 'color'=> 'green'],
            ['name' => 'pear', 'color' => 'yellow']
        ]));
        $pdo->method('prepare')->will($this->returnValue($stmt));

        $serverId = 'xdfsa';
        $cnn = new Cnn($pdo, $serverId);

        $fruits = $cnn->select('*')
            ->from($cnn->table('tableA'))
            ->listAssoc();

        $this->assertEquals(
            [
                ['name' => 'apple', 'color'=> 'green'],
                ['name' => 'pear', 'color' => 'yellow']
            ],
            $fruits
        );
    }

    public function testList(): void
    {
        $pdo = $this->createMock('PDO');
        $stmt = $this->createMock('PDOStatement');
        $stmt->method('execute')->will($this->returnValue(true));
        $stmt->method('fetch')->will($this->onConsecutiveCalls(
            ['name' => 'apple', 'color'=> 'green'],
            ['name' => 'pear', 'color' => 'yellow']
        ));
        $pdo->method('prepare')->will($this->returnValue($stmt));

        $serverId = 'xdfsa';
        $cnn = new Cnn($pdo, $serverId);

        $fruits = $cnn->select('*')
            ->from($cnn->table('tableA'))
            ->list(FruitDto::class);

        $this->assertEquals(
            [
                new FruitDto(['name' => 'apple', 'color'=> 'green',]),
                new FruitDto(['name' => 'pear', 'color' => 'yellow'])
            ],
            $fruits->toArray()
        );
    }
}
