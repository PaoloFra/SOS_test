<?php

class TbSource extends \Phalcon\Mvc\Model
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
    public $rx;

    /**
     *
     * @var string
     */
    public $title;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tb_source';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbSource[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbSource
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function initialize()
    {
        $this->hasMany('cx', 'TbRel', 'cx');
    }

    /**
     * Independent Column Mapping.
     */
    public static function columnHeaders()
    {
        return [
            'name' => 'Имя',
            'phone' => 'телефон',
            'mail' => 'email',
            'message' => 'сообщение',
            'date' => 'дата'
        ];
    }

}