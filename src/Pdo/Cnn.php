<?php
namespace Gap\Db\Pdo;

//use Gap\Db\CnnInterface;

class Cnn
{
    protected $pdo;
    protected $serverId;
    protected $trans;
    protected $paramArr = [];

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

    public function str(string $val): Param\ParamStr
    {
        $param = new Param\ParamStr($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function int(int $val): Param\ParamInt
    {
        $param = new Param\ParamInt($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function bool(bool $val): Param\ParamBool
    {
        $param = new Param\ParamBool($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function dateTime(\DateTime $val): Param\ParamDateTime
    {
        $param = new Param\ParamDateTime($val);
        $this->paramArr[] = $param;
        return  $param;
    }

    public function expr(string $expr): Param\ParamExpr
    {
        return new Param\ParamExpr($expr);
    }

    public function query(string $sql): Statement
    {
        $stmt = new Statement($this->pdo->prepare($sql));
        $stmt->bindParam(...$this->paramArr);
        $stmt->execute();
        $this->paramArr = [];
        return $stmt;
    }
    /*
    public function prepare(string $sql): Statement
    {
        return new Statement($this->pdo->prepare($sql));
    }
    */
}
