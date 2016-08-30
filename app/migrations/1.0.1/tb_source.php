<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class TbSourceMigration_101
 */
class TbSourceMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('tb_source', array(
                'columns' => array(
                    new Column(
                        'cx',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 10,
                            'first' => true
                        )
                    ),
                    new Column(
                        'rx',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 10,
                            'after' => 'cx'
                        )
                    ),
                    new Column(
                        'title',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 100,
                            'after' => 'rx'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('cx', array('cx'), null),
                    new Index('rx', array('rx'), null)
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_general_ci'
                ),
            )
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
