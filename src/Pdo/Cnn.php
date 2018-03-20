<?php
namespace Gap\Db\Pdo;

//use Gap\Db\CnnInterface;

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

    public function trans(): Transaction
    {
        if ($this->trans) {
            return $this->trans;
        }

        $this->trans = new Transaction($this->pdo);
        return $this->trans;
    }

    public function zid(): string
    {
        return uniqid($this->serverId . '-');
    }

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
