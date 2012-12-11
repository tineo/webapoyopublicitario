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
		
		/*
		 * $galeria = new Gallery(); $galeria->setName("test");
		 * $galeria->setDescripcion("prueba");
		 * $this->getEntityManager()->persist($galeria);
		 * $this->getEntityManager()->flush();
		 */
		return new ViewModel ();
	}
	public function landingAction() {
		
		// $vars['galleries'] =
		// $this->getEntityManager()->getRepository('Application\Entity\Gallery')->findAll();
		//$dir = __DIR__ . "/../../../../../public/_images/_galerias/" . strtoupper ( $this->getEvent ()->getRouteMatch ()->getParam ( 'galeria' ) ) . "";
		
		//$files = scandir ( $dir );
		// print_r ( $files );
		
		$viewModel = new ViewModel ();
		$viewModel->setTemplate ( "projects/landing" );
		
		switch ($this->getEvent ()->getRouteMatch ()->getParam ( 'section' )) {
			case "tec" :
				$vars ['imagen_back'] = 'images/st.png';
				break;
			
			case "pic" :
				$vars ['imagen_back'] = 'images/banco2.png';
				break;
			
			case "tipv" :
				$vars ['imagen_back'] = 'images/innivaciones.jpg';
				break;
			
			case "ptm" :
				$vars ['imagen_back'] = 'images/ptm.png';
				break;
			
			default :
				$viewModel->setTemplate ( "error/index" );
				break;
		}
		
		if (($this->getEvent ()->getRouteMatch ()->getParam ( 'id' )) != "") {
			
			if (($this->getEvent ()->getRouteMatch ()->getParam ( 'galeria' )) == "") {
				$sx = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Section' )->findOneBy ( array (
						'descripcion' => strtoupper ( $this->getEvent ()->getRouteMatch ()->getParam ( 'section' ) ) 
				) );
				$gx = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Gallery' )->findBy ( array (
						'id_section' => $sx->getId () 
				) );
				$slug = $gx [0]->getSlug ();
			} else {
				$slug = $this->getEvent ()->getRouteMatch ()->getParam ( 'galeria' );
			}
			
			$section = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Section' )->findOneBy ( array (
					'descripcion' => strtoupper ( $this->getEvent ()->getRouteMatch ()->getParam ( 'section' ) ) 
			) );
			
			$galeria = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Gallery' )->findOneBy ( array (
					'slug' => $slug 
			) );
			if (count ( $galeria ) > 0) {
				
				$g = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Gallery' )->findBy ( array (
						'id_section' => $section->getId() 
				) );
				$i = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Item' )->findBy ( array (
						'id_gallery' => $galeria->getId () 
				) );
				
				$viewModel->setTemplate ( "projects/gallery" );
				$vars ["id"] = $this->getEvent ()->getRouteMatch ()->getParam ( 'id' );
				$vars ["secciones"] = $g;
				$vars ["items"] = $i;
			} else {
				
				$viewModel->setTemplate ( "error/404" );
			}
		}
		
		$vars ["section"] = $this->getEvent ()->getRouteMatch ()->getParam ( 'section' );
		$vars ["galeria"] = $this->getEvent ()->getRouteMatch ()->getParam ( 'galeria' );
		$viewModel->setVariables ( $vars );
		return $viewModel;
	}
}
