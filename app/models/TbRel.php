<?php

namespace Models;

class TbRel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $cx;

    /**
     *
     * @var string
     */
    public $ndc;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tb_rel';
    }

    public function initialize()
    {
//        $this->hasMany('cx', 'TbSource', 'cx');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbRel[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbRel
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
