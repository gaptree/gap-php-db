<?php
namespace phpunit\Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Cnn;

class UpdateSqlBuilderTest extends SqlBuilderTestBase
{
    public function testSimpleUpdate(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $usb = $cnn->usb()
            ->update('tableA a', 'tableB b')->end()
            ->set('a.col1')->expr('b.col1')
            ->set('a.col2')->str('val2')
            ->set('a.col3')->int(3);

        $this->assertEquals(
            'UPDATE tableA a, tableB b'
            . ' SET a.col1 = b.col1, a.col2 = :k1, a.col3 = :k2',
            $usb->sql()
        );
    }

    public function testJoin(): void
    {
        $this->initParamIndex();
        $cnn = $this->getCnn();
        $usb = $cnn->usb()
            ->update('tableA a', 'tableB b')
                ->leftJoin('tableC c', 'tableD d')
                ->onCond()
                    ->expect('c.col1')->equal()->expr('a.col1')
                    ->andExpect('d.col2')->equal()->expr('b.col2')
                ->endJoin()
            ->end()
            ->set('a.col1')->expr('b.col1')
            ->set('a.col2')->str('val2')
            ->set('a.col3')->int(3)
            ->where()
                ->expect('a.col1')->equal()->str('v1')
            ->end();

        $this->assertEquals(
            'UPDATE tableA a, tableB b'
            . ' LEFT JOIN tableC c, tableD d ON c.col1 = a.col1 AND d.col2 = b.col2'
            . ' SET a.col1 = b.col1, a.col2 = :k1, a.col3 = :k2'
            . ' WHERE a.col1 = :k3',
            $usb->sql()
        );
    }
}
