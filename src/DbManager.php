<?php
namespace Gap\Db;

use Gap\Db\Contract\CnnInterface;
use Gap\Db\Contract\DbManagerInterface;

class DbManager implements DbManagerInterface
{
    protected $optsArr = [];
    protected $cnnArr = [];
    protected $serverId = '';

    protected $driverMap = [
        'mysql' => 'MySql'
    ];

    public function __construct(array $optsArr, string $serverId)
    {
        $this->optsArr = $optsArr;
        $this->serverId = $serverId;
    }

    public function connect(string $name): CnnInterface
    {
        if (isset($this->cnnArr[$name])) {
            return $this->cnnArr[$name];
        }

        if (!$opts = $this->optsArr[$name] ?? null) {
            throw new \Exception("Cannot find db: $name");
        }

        $driver = $opts['driver'] ?? 'mysql';
        $host = $opts['host'] ?? '';
        $database = $opts['database'] ?? '';
        $port = $opts['port'] ?? 3306;
        $username = $opts['username'];
        $password = $opts['password'];
        $charset = $opts['charset'] ?? 'utf8mb4';

        $dsn = "$driver:host=$host;port=$port;dbname=$database;charset=$charset";
        if (!$driver || !$host || !$database) {
            throw new \Exception("db config has error: $name - $dsn");
        }

        $pdo = new \PDO(
            $dsn,
            $username,
            $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_PERSISTENT => false,
                \PDO::MYSQL_ATTR_INIT_COMMAND =>"SET time_zone = '+00:00'"
            ]
        );
        // todo ATTR_PERSISTENT true OR false

        $driverClass = $this->getDriverClass($driver);
        $class = "Gap\\Db\\{$driverClass}\\Cnn";
        $this->cnnArr[$name] = new $class($pdo, $this->serverId);

        return $this->cnnArr[$name];
    }

    protected function getDriverClass(string $driver): string
    {
        return $this->driverMap[$driver] ?? '';
    }
}
