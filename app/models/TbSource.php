<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

class TbSource extends Model
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
        $this->hasMany('cx', '\Models\TbRel', 'cx',
            [
                "alias" => "TbRel",
//                "foreignKey" => [
//                    "allowNulls" => true,
//                    "action" => Relation::ACTION_CASCADE,
//                    "message"    => "cx нет в модели TbRel"
//                ]
            ]);
    }

    /**
     * Independent Column Mapping.
     */
    public static function columnHeaders()
    {
        return [
            'cx' => 'cx',
            'rx' => 'rx',
            'title' => 'title',
            'NDC' => 'NDC'
        ];
    }

}
