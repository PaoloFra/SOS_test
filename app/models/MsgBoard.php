<?php

namespace Models;

class MsgBoard extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $mail;

    /**
     *
     * @var string
     */
    public $message;

    /**
     *
     * @var string
     */
    public $date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
//        $this->setSchema("public");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'msg_board';
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

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MsgBoard[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MsgBoard
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
