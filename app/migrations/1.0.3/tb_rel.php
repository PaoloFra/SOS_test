<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class TbRelMigration_103
 */
class TbRelMigration_103 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('tb_rel', array(
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
                        'ndc',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 20,
                            'after' => 'cx'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('cx', array('cx'), null),
                    new Index('ndc', array('ndc'), null)
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
