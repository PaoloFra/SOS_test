<?php
 
class IndexController extends Phalcon\Mvc\Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $start = microtime(TRUE);

        $grid = new \Grids\TbSourceGrid();
        $this->view->page = $grid->render();
        $this->view->headings = $grid->getColumns();

        echo "time: ", microtime(TRUE) - $start, "\n";
    }

    /**
     * Store a record
     */
    public function storeAction()
    {
        $this->view->disable();
        if ($this->request->isAjax()) {
            echo \Forms\msgBoardForm::createMsg($this->request);
        }
    }

    /**
     * Delete a record
     */
    public function removeAction()
    {
        $this->view->disable();
        if ($this->request->isAjax()) {
            echo \Forms\msgBoardForm::removeMsg($this->request->getPost("id", "int"));
        }
    }
}
