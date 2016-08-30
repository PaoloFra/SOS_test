<?php
 
class IndexController extends Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $start = microtime(TRUE);

        $grid = new \Grids\TbSourceGrid();
        $this->view->page = $grid->render();
        $this->view->headings = $grid->getColumns();
        $this->view->timer = microtime(TRUE) - $start;
        $this->view->mode = ' ORM process:';
    }

    public function ormcAction()
    {
        $this->view->pick("index/index");
        $start = microtime(TRUE);

        $grid = new \Grids\TbSourceGrid();
        $this->view->page = $grid->render('ORMC');
        $this->view->headings = $grid->getColumns();
        $this->view->timer = microtime(TRUE) - $start;
        $this->view->mode = ' ORM Cached process:';
    }

    public function sqlAction()
    {
        $this->view->pick("index/index");
        $start = microtime(TRUE);

        $grid = new \Grids\TbSourceGrid();
        $this->view->page = $grid->render('SQL');
        $this->view->headings = $grid->getColumns();
        $this->view->timer = microtime(TRUE) - $start;
        $this->view->mode = ' SQL process:';
    }

}
