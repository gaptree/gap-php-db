<?php
namespace phpunit\Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Cnn;

class SelectSqlBuilderTest extends SqlBuilderTestBase
{
    public function testSimple(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $ssb = $cnn->ssb()
            ->select('a.*', 'b.col1', 'b.col2')
            ->from('tableA a', 'tableB b')->end()
            ->where()
                ->expect('a.col1')->equal()->str('v1')
            ->end();

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' WHERE a.col1 = :k1'
            . ' LIMIT 10',
            $ssb->sql()
        );
    }

    public function testLike(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $ssb = $cnn->ssb()
            ->select('a.*', 'b.col1', 'b.col2')
            ->from('tableA a', 'tableB b')->end()
            ->where()
                ->expect('a.col1')->like()->str('%hello%')
            ->end();

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' WHERE a.col1 LIKE :k1'
            . ' LIMIT 10',
            $ssb->sql()
        );
    }

    public function testJoin(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $ssb = $cnn->ssb()
            ->select('a.*', 'b.col1', 'b.col2')
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
            $ssb->sql()
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

        $fruit = $cnn->ssb()
            ->select('*')
            ->from('fruit')->end()
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

        $fruits = $cnn->ssb()
            ->select('*')
            ->from('tableA')->end()
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
        $fruits = $cnn->ssb()
            ->select('*')
            ->from('tableA')->end()
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
