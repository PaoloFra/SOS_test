<?php

namespace Grids;

//use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Tag;
//use Phalcon\Cache\Backend\File as BackFile;
//use Phalcon\Cache\Frontend\Data as FrontData;
//use Phalcon\Cache\Frontend\Data as FrontendData;
//use Phalcon\Cache\Backend\Memcache as BackendMemcache;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;



class TbSourceGrid extends \Phalcon\Mvc\Controller
{

    public function render( $mode = 'ORM')
    {
        $r = $this->request;

        if (!is_array($this->persistent->parameters) || $r->getQuery("reset", "int")) {
            $this->persistent->parameters = [
                'qry' => [
                    'conditions' => "title LIKE 'title 1%'",
                    'order' => "id asc"
                ],
                'sort' => [
                    'page'  => 1,
                    'perpage' => 10,
                    'sortField' => 'id',
                    'sortOrder' => 'asc'
                ],
                'term' => 'title 1'
            ];
        }

        $parameters = $this->persistent->parameters;

        $numberPage = 1;

        if ($r->isPost()) {
            $term = $r->getPost("term", "string")?:'';
            $parameters['qry']['conditions'] = "title LIKE :term: ";
            $parameters['qry']['bind'] = [ "term" => $term.'%'];
            $parameters['term'] = $term;
        } else {
            $numberPage = $r->getQuery("page", "int");
            $parameters['sort']['sortField'] = $sortField = $r->getQuery("sort", "alphanum")?:$parameters['sort']['sortField'];
            $parameters['sort']['sortOrder'] = $sortOrder = $r->getQuery("order", "alphanum")?:$parameters['sort']['sortOrder'];
            $parameters['qry']['order'] = "$sortField $sortOrder";
        }

        switch ($mode) {
            case 'ORM' :
                unset($parameters['qry']['cache']);
                $vhData = \Models\TbSource::find($parameters['qry']);
                break;

            case 'ORMC' :
                $cacheKey = 'vh-key_'.$parameters['sort']['sortField'].'_'.$parameters['sort']['sortOrder'];
                $parameters['qry']['cache'] = [ "lifetime" => 3600, "key" => $cacheKey ];
//                $parameters['qry']['limit'] = 5000000 ;
                $vhData = \Models\TbSource::find($parameters['qry']);
                break;

            case 'SQL' :
                $cat = new \Models\TbSource();
                $sql = "SELECT ts.*, tr.ndc FROM `tb_source` ts
                        LEFT JOIN `tb_rel` tr ON tr.cx=ts.cx
                        WHERE ts.title LIKE '{$parameters['term']}%'
                        ORDER BY {$parameters['qry']['order']}";

                $vhData = new Resultset(null, $cat, $cat->getReadConnection()->query($sql));
                break;
        }

        $this->persistent->parameters = $parameters;
        Tag::displayTo("term", $parameters['term']);

        $paginator = new Paginator([
            "data" => $vhData,
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

