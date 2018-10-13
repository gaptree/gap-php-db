<?php
namespace Gap\Db\Pdo;

//use Gap\Db\CnnInterface;
use Gap\Db\Contract\TransactionInterface;

class Cnn
{
    use CnnParamTrait;

    protected $pdo;
    protected $serverId;
    protected $trans;
    protected $paramArr = [];

    protected $executed = [];

    public function __construct(\PDO $pdo, string $serverId)
    {
        $this->pdo = $pdo;
        $this->serverId = $serverId;
    }

    public function trans(): TransactionInterface
    {
        if ($this->trans) {
            return $this->trans;
        }

        $this->trans = new Transaction($this->pdo);
        return $this->trans;
    }

    public function lastInsertId(string $name = null)
    {
        return $this->pdo->lastInsertId($name);
    }

    public function uniqBin(int $len = 10): string
    {
        // https://jason.pureconcepts.net/2013/09/php-convert-uniqid-to-timestamp/
        // https://mariadb.com/kb/en/library/guiduuid-performance/
        if ($len < 8) {
            throw new \Exception("Length of uniqBin cannot less than 8");
        }

        $preLen = 6;
        $micros = intval(microtime(true) * (10 ** 8));
        $pre = substr(dechex($micros), 0, $preLen * 2);
        return hex2bin($pre) . random_bytes($len - $preLen);
    }

    // deprecated
    public function zid(): string
    {
        return uniqid($this->serverId . '-');
    }

    // deprecated
    public function zcode(): string
    {
        return uniqid($this->serverId);
    }

    public function query(string $sql): Statement
    {
        $stmt = new Statement($this->pdo, $sql);
        $stmt->bindParam(...$this->paramArr);
        $stmt->execute();
        $this->paramArr = [];
        $this->executed[] = $stmt;
        return $stmt;
    }

    public function executed(): array
    {
        return $this->executed;
    }
    /*
    public function prepare(string $sql): Statement
    {
        return new Statement($this->pdo->prepare($sql));
    }
    */
}
