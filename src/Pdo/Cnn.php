<?php
namespace Gap\Db\Pdo;

//use Gap\Db\CnnInterface;

class Cnn
{
    protected $pdo;
    protected $serverId;
    protected $trans;

    protected $currentCtrl;
    protected $currentSql;

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

    public function prepare(string $sql): Statement
    {
        return new Statement($this->pdo->prepare($sql));
    }

    public function sql(): string
    {
        return $this->currentSql->sql();
    }
}
