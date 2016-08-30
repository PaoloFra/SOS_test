<?php

namespace Grids;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TbSourceGrid extends \Phalcon\Mvc\Controller
{
    public function findAll()
    {
//        $sortField = 'id';
//        $sortOrder = 'desc';
//
//        $paginator = new Paginator([
//            "data" => \Models\TbSource::find(['order' => "$sortField $sortOrder"]),
//            "limit"=> 5,
//            "page" => 1
//        ]);
//        return $paginator->getPaginate();
    }

    public function render()
    {
        $r = $this->request;

        if (!is_array($this->persistent->parameters) || $r->getQuery("reset", "int")) {
            $this->persistent->parameters = [
                'qry' => [
                    'order' => "id asc"
                ],
                'sort' => [
                    'page'  => 1,
                    'perpage' => 10,
                    'sortField' => 'id',
                    'sortOrder' => 'asc'
                ]
            ];
        }

        $parameters = $this->persistent->parameters;

        $numberPage = 1;
        if ($r->isPost()) {
            $query = Criteria::fromInput($this->di, '\Models\TbSource', $r->getPost());
            $parameters['qry'] = $query->getParams();
        } else {
            $numberPage = $r->getQuery("page", "int");
            $parameters['sort']['sortField'] = $sortField = $r->getQuery("sort", "alphanum")?:$parameters['sort']['sortField'];
            $parameters['sort']['sortOrder'] = $sortOrder = $r->getQuery("order", "alphanum")?:$parameters['sort']['sortOrder'];
            $parameters['qry']['order'] = "$sortField $sortOrder";
        }

        $this->persistent->parameters = $parameters;

        $paginator = new Paginator([
            "data" => \Models\TbSource::find($parameters['qry']),
            "limit"=> 10,
            "page" => $numberPage
        ]);
        return $paginator->getPaginate();
    }

    public function getColumns()
    {
        $parameters = $this->persistent->parameters;
        $sortField = $parameters['sort']['sortField'];
        $sortOrder = $parameters['sort']['sortOrder'];
        // sorting and table headers mapping
        $headMapping = \Models\TbSource::columnHeaders();
        // get sorting header and order arrow
        $headings = [];
        foreach ($headMapping as $field => $name) {
            $headings[$field] = [
                'field' => $field,
                'name' => $name,
                'sort' => ($sortField == $field) ? (($sortOrder == 'desc') ? 'asc' : 'desc') : false,
                'arrow' => ($sortField == $field) ? (($sortOrder == 'desc') ? '&nbsp;&#8595;' : '&nbsp;&#8593;') : false,
            ];
        }

       return $headings;
    }
}

