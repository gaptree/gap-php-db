<?php
namespace phpunit\Gap\Db\MySql\Sql;

class InsertSqlTest extends SqlTestBase
{
    public function testSimple(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $insert = $cnn->insert('tableA')
            ->field('col1', 'col2', 'col3')
            ->value(
                $cnn->value()
                    ->add($cnn->int(2))
                    ->add($cnn->str('val2'))
                    ->add($cnn->dateTime(new \DateTime('2018-3-10')))
            )
            ->value(
                $cnn->value()
                    ->add($cnn->int(3))
                    ->add($cnn->str('val22'))
                    ->add($cnn->dateTime(new \DateTime('2018-3-10')))
            );

        $this->assertEquals(
            'INSERT INTO tableA'
            . ' (col1, col2, col3)'
            . ' VALUES '
            . '(:k1, :k2, :k3)'
            . ', (:k4, :k5, :k6)',
            $insert->sql()
        );
    }
}
