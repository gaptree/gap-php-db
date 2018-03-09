<?php
namespace phpunit\Gap\Db\MySql\Ctrl;

use PHPUnit\Framework\TestCase;
use Gap\Db\Pdo\Param\ParamBase;
use Gap\Db\MySql\Cnn;

class UpdateCtrlTest extends TestCase
{
    protected $cnn;

    protected function setUp(): void
    {
        $pdo = $this->createMock('PDO');
        $serverId = 'xdfsa';
        $this->cnn = new Cnn($pdo, $serverId);
    }

    public function testSimple(): void
    {
        $this->initParamIndex();
        $this->cnn->update('tableA a', 'tableB b')
            ->set('a.col1')->beExpr('b.col1')
            ->set('a.col2')->beStr('val2')
            ->set('a.col3')->beInt(3);

        $this->assertEquals(
            'UPDATE tableA a, tableB b'
            . ' SET a.col1 = b.col1, a.col2 = :k1, a.col3 = :k2',
            $this->cnn->sql()
        );
    }

    public function testJoin(): void
    {
        $this->initParamIndex();
        $this->cnn->update('tableA a', 'tableB b')
            ->leftJoin('tableC c', 'tableD d')
            ->onCond()
                ->expect('c.col1')->beExpr('a.col1')
                ->andExpect('d.col2')->beExpr('b.col2')
            ->set('a.col1')->beExpr('b.col1')
            ->set('a.col2')->beStr('val2')
            ->set('a.col3')->beInt(3)
            ->where()
                ->expect('a.col1')->beStr('v1');

        $this->assertEquals(
            'UPDATE tableA a, tableB b'
            . ' LEFT JOIN tableC c, tableD d ON c.col1 = a.col1 AND d.col2 = b.col2'
            . ' SET a.col1 = b.col1, a.col2 = :k1, a.col3 = :k2'
            . ' WHERE a.col1 = :k3',
            $this->cnn->sql()
        );
    }

    protected function initParamIndex(): void
    {
        ParamBase::initIndex();
    }
}
