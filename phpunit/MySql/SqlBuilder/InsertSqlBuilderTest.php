<?php
namespace phpunit\Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Cnn;

class InsertSqlBuilderTest extends SqlBuilderTestBase
{
    public function testSimple(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $isb = $cnn->isb()
            ->insert('tableA')
            ->field('col1', 'col2', 'col3')
            ->value()
                ->addInt(2)
                ->addStr('val2')
                ->addDateTime(new \DateTime('2018-3-10'))
            ->end()
            ->value()
                ->addInt(3)
                ->addStr('val22')
                ->addDateTime(new \DateTime('2018-3-10'))
            ->end();

        $this->assertEquals(
            'INSERT INTO tableA'
            . ' (col1, col2, col3)'
            . ' VALUES '
            . '(:k1, :k2, :k3)'
            . ', (:k4, :k5, :k6)',
            $isb->sql()
        );
    }

    public function testOnDuplate(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $isb = $cnn->isb()
            ->insert('tableA')
            ->field('col1', 'col2', 'col3')
            ->value()
                ->addInt(3)
                ->addStr('val22')
                ->addDateTime(new \DateTime('2018-3-10'))
            ->end()
            ->value()
                ->addInt(3)
                ->addStr('val22')
                ->addDateTime(new \DateTime('2018-3-10'))
            ->end()
            ->onDuplicate('col1')->str('changed col1')
            ->onDuplicate('col2')->str('changed col2');

        $this->assertEquals(
            'INSERT INTO tableA'
            . ' (col1, col2, col3)'
            . ' VALUES '
            . '(:k1, :k2, :k3)'
            . ', (:k4, :k5, :k6)'
            . ' ON DUPLICATE KEY UPDATE col1 = :k7, col2 = :k8',
            $isb->sql()
        );
    }
}
