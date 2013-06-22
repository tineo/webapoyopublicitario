<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\View;
use Zend\View\Model\ViewModel;


class StandsxController extends AbstractActionController {
  public function indexAction() {
    return new ViewModel ();
  }
        
  public function proyectosAction() {
    $viewModel = new ViewModel ();
    
    $vars = array();
    $vars['gallery'] = $this->getEvent ()->getRouteMatch ()->getParam ( 'gallery' );
    
    // Galería por defecto
    if($vars['gallery'] === NULL) {
      $vars['gallery'] = 'extemin2011';
    }
    
    return $viewModel;
  }
}

