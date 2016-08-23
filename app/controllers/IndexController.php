<?php
 
class IndexController extends Phalcon\Mvc\Controller
{

    private $APIService;

    /**
     * Index action
     */
    public function indexAction()
    {
//        $grid = new \Grids\msgBoardGrid();
//        $this->view->page = $grid->render();
//        $this->view->headings = $grid->getColumns();
    }

    /**
     * Store a record
     */
    public function getEstimateAction()
    {
        $this->view->disable();

        $this->APIService = new uberAPI();

        if ($this->request->isAjax()) {
            echo $this->APIService->getEstimate($this->request);
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
