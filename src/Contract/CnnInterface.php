<?php
namespace Gap\Db\Contract;

interface CnnInterface
{
    public function trans(): TransactionInterface;
    public function zid(): string;
    public function zcode(): string;

    public function ssb(): SqlBuilder\SelectSqlBuilderInterface;
    public function dsb(): SqlBuilder\DeleteSqlBuilderInterface;
    public function usb(): SqlBuilder\UpdateSqlBuilderInterface;
    public function isb(): SqlBuilder\InsertSqlBuilderInterface;
}
