<?php
namespace phpunit\Gap\Db\MySql;

use PHPUnit\Framework\TestCase;
use Gap\Db\Pdo\Cnn;

class CnnTest extends TestCase
{
    public function testConstruct(): void
    {
        $pdo = $this->createMock('\PDO');
        $cnn = new Cnn($pdo, 'xdfdsa');

        $this->assertInstanceOf('\Gap\Db\CnnInterface', $cnn);
    }
}
