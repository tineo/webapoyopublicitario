<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\View;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Entity\Gallery;

class ProjectsController extends AbstractActionController {
	
	/**
	 *
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;
	public function setEntityManager(EntityManager $em) {
		$this->em = $em;
	}
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator ()->get ( 'Doctrine\ORM\EntityManager' );
		}
		return $this->em;
	}
	
	
	
	public function indexAction() {
		
		/*$galeria = new Gallery();
		$galeria->setName("test");
		$galeria->setDescripcion("prueba");
		
		
		$this->getEntityManager()->persist($galeria);
		$this->getEntityManager()->flush();
		*/
		
	
		return new ViewModel ();
		
	}
	public function tecAction() {
		
		$vars['galleries'] = $this->getEntityManager()->getRepository('Application\Entity\Gallery')->findAll();
		
		
		$dir = __DIR__ . "/../../../../../public/_images/_galerias/" . strtoupper ( $this->getEvent ()->getRouteMatch ()->getParam ( 'action' ) ) . "";
		
		$files = scandir ( $dir );
		//print_r ( $files );
		
		//echo __NAMESPACE__;
		// echo ucfirst($this->section);
		// echo APPLICATION_ENV;
		$viewModel = new ViewModel ();
		$viewModel->setTemplate ( "projects/landing" );
		
		$vars ["action"] = $this->getEvent ()->getRouteMatch ()->getParam ( 'action' );
		
		if ($this->getEvent ()->getRouteMatch ()->getParam ( 'id' ) == "gallery") {
			$viewModel->setTemplate ( "projects/gallery" );
			$vars ["id"] = $this->getEvent ()->getRouteMatch ()->getParam ( 'id' );
			$vars ["section"] = $this->getEvent ()->getRouteMatch ()->getParam ( 'section' );
		}
		
		$viewModel->setVariables ( $vars );
		
		return $viewModel;
	}
}
