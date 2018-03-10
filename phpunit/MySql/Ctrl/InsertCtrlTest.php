<?php
namespace phpunit\Gap\Db\MySql\Ctrl;

class InsertCtrlTest extends CtrlTestBase
{
    public function testSimple(): void
    {
        $this->initParamIndex();
        $this->cnn->insert('tableA')
            ->field('col1', 'col2', 'col3')
            ->value()
                ->addInt(2)
                ->addStr('val2')
                ->addDatetime(new \DateTime('2018-3-10'))
            ->value()
                ->addInt(3)
                ->addStr('val22')
                ->addDatetime(new \DateTime('2018-3-10'));

        $this->assertEquals(
            'INSERT INTO tableA'
            . ' (col1, col2, col3)'
            . ' VALUES '
            . '(:k1, :k2, :k3)'
            . ', (:k4, :k5, :k6)',
            $this->cnn->sql()
        );
    }
}
