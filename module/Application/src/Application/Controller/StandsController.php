<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\View;
use Zend\View\Model\ViewModel;


class StandsController extends AbstractActionController {
  public function indexAction() {
    return new ViewModel ();
  }



  public function galleryAction() {
    $params = $this->getRequest()->getQuery();
    $imagenes = scandir( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/public/_images/portfolio/".$params['trend'] );
    foreach ( $imagenes as $imagen ) {
      if ($imagen != "thumb.jpg" && $imagen != "thumbs" && $imagen != "." && $imagen != "..") {
          $thumbs="_images/portfolio/".$params['trend']."/thumbs/".$imagen;          
          $url ="_images/portfolio/".$params['trend']."/".$imagen;
          $imagen = substr($imagen, 0, -4);
          $name = explode("@",$imagen);
          $img[] = array('desc' => $name[1].", ".$name[2],'url' => $url, 'thumbs' => $thumbs);
         }
       }
    $result = new \Zend\View\Model\JsonModel(array(
            'trend' => $params['trend'],
            'path'=> dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/public/_images/portfolio/",
            'images' => $img
        ));
    return $result;
  }

  public function undefinedAction(){
    return null;
  }
        
  public function proyectosAction() {
    $viewModel = new ViewModel ();
    return $viewModel;
  }

  public function membresiasAction(){
    return new ViewModel ();
  }

  public function proveedoresAction(){
    return new ViewModel ();
  }
}
