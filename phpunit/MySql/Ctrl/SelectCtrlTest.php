<?php
namespace phpunit\Gap\Db\MySql\Ctrl;

use PHPUnit\Framework\TestCase;
use Gap\Db\MySql\Cnn;

class SelectCtrlTest extends TestCase
{
    protected $cnn;

    protected function setUp(): void
    {
        $pdo = $this->createMock('PDO');
        $serverId = 'xdfsa';
        $this->cnn = new Cnn($pdo, $serverId);
    }

    public function testFrom(): void
    {
        $sqlCtrl = $this->cnn->select('a.*', 'b.col1', 'b.col2')
            ->from('tableA a', 'tableB b');

        $this->assertEquals(
            'SELECT a.*, b.col1, b.col2'
            . ' FROM tableA a, tableB b'
            . ' LIMIT 10 OFFSET 0',
            $sqlCtrl->sql()
        );
    }

    public function testJoin(): void
    {
        $sqlCtrl = $this->cnn->select('a.*', 'b.col1', 'b.col2')
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
            ->from('fruit')
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
            ->from('tableA')
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
        $stmt->method('fetch')->will($this->returnValue([
            'name' => 'apple', 'color'=> 'green',
        ]));
        $pdo->method('prepare')->will($this->returnValue($stmt));

        $serverId = 'xdfsa';
        $cnn = new Cnn($pdo, $serverId);

        $fruits = $cnn->select('*')
            ->from('tableA')
            ->list(FruitDto::class);

        $fruits->rewind();

        $this->assertEquals(
            new FruitDto([
                'name' => 'apple', 'color'=> 'green',
            ]),
            $fruits->current()
        );
    }
}
