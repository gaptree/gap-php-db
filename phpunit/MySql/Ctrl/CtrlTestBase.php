<?php
namespace phpunit\Gap\Db\MySql\Ctrl;

use PHPUnit\Framework\TestCase;
use Gap\Db\Pdo\Param\ParamBase;
use Gap\Db\MySql\Cnn;

class CtrlTestBase extends TestCase
{
    protected $cnn;

    protected function setUp(): void
    {
        $pdo = $this->createMock('PDO');
        $serverId = 'xdfsa';
        $this->cnn = new Cnn($pdo, $serverId);
    }

    /**
     * @SuppressWarnings(PHPMD)
     */
    protected function initParamIndex(): void
    {
        ParamBase::initIndex();
    }
}
