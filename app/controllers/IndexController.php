<?php
 
class IndexController extends Phalcon\Mvc\Controller
{

    private $APIService;

    /**
     * Index action
     */
    public function indexAction()
    {

    }

    /**
     * find Prices
     */
    public function getEstimateAction()
    {
        $this->view->disable();

        $this->APIService = new UberAPI();

        if ($this->request->isAjax()) {
            echo $this->APIService->getEstimate($this->request);
        }
    }

}
