<?php
namespace phpunit\Gap\Db;

use PHPUnit\Framework\TestCase;
use Gap\Db\DbManager;

class DbManagerTest extends TestCase
{
    public function testConnect(): void
    {
        $dbManager = new DbManager($this->getOptsArr(), 'xdfds');
        $cnn = $dbManager->connect('default');
        $this->assertInstanceOf('\Gap\Db\CnnInterface', $cnn);
    }

    protected function getOptsArr(): array
    {
        return [
            'default' => [
                'driver' => 'mysql',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'database' => '%local.db.database%',
                'host' => '%local.db.host%',
                'username' => '%local.db.username%',
                'password' => '%local.db.password%'
            ],
            'i18n' => [
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'driver' => 'mysql',
                'database' => '%local.db.database%',
                'host' => '%local.db.host%',
                'username' => '%local.db.username%',
                'password' => '%local.db.password%'
            ],
            'meta' => [
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'driver' => 'mysql',
                'database' => '%local.db.database%',
                'host' => '%local.db.host%',
                'username' => '%local.db.username%',
                'password' => '%local.db.password%'
            ],
        ];
    }
}
