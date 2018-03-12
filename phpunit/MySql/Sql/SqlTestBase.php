<?php
namespace phpunit\Gap\Db\MySql\Sql;

use PHPUnit\Framework\TestCase;
use Gap\Db\Pdo\Param\ParamBase;
use Gap\Db\MySql\Cnn;

class SqlTestBase extends TestCase
{
    protected function getCnn(): Cnn
    {
        $pdo = $this->createMock('PDO');
        $serverId = 'gap-db';
        return new Cnn($pdo, $serverId);
    }

    /**
     * @SuppressWarnings(PHPMD)
     */
    protected function initParamIndex(): void
    {
        ParamBase::initIndex();
    }
}
