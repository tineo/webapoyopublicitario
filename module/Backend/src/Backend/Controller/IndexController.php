<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Backend\Controller;

use Zend\View\View;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Backend\Entity\Gallery;
use Backend\Entity\Section;
use Backend\Entity\Item;

class IndexController extends AbstractActionController {
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
	public function zerofill($num, $zerofill = 2) {
		return str_pad ( $num, $zerofill, '0', STR_PAD_LEFT );
	}
	public function indexAction() {
		$viewModel = new ViewModel ();
		$secciones = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Section' )->findAll ();
		
		foreach ( $secciones as $s ) {
			
			$galerias = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Gallery' )->findBy ( array (
					'id_section' => $s->getId () 
			) );
			unset ( $galeria );
			foreach ( $galerias as $g ) {
				$items = $this->getEntityManager ()->getRepository ( 'Backend\Entity\Item' )->findBy ( array (
						'id_gallery' => $g->getId () 
				) );
				unset ( $item );
				foreach ( $items as $it ) {
					$item [] = array (
							"path_thumb" => $it->getPath_thumb () 
					);
				}
				
				$galeria [] = array (
						"descripcion" => $g->getDescripcion (),
						"id" => $g->getId (),
						"items" => $item 
				);
			}
			
			$sections [] = array (
					"descripcion" => $s->getDescripcion (),
					"id" => $s->getId (),
					"galerias" => $galeria 
			);
		}
		
		// $sec = $this->getEntityManager ()->find ( 'Backend\Entity\Section', 1
		// );
		// $sec = $this->getEntityManager
		// ()->getRepository('Backend\Entity\Section')->find(1);
		// $sec = $this->getEntityManager
		// ()->getRepository('Backend\Entity\Section')->findBy(array('descripcion'
		// => 'TEC'));
		
		/*
		 * $g = $this->getEntityManager ()->getRepository (
		 * 'Backend\Entity\Gallery' )->findBy ( array ( 'id_section' => 1 ) );
		 */
		
		$vars ["dump"] = $galerias;
		
		$vars ["sections"] = $sections;
		
		$vars ["data"] = getcwd () . "/public/_gallery";
		$viewModel->setVariables ( $vars );
		// $viewModel->setTemplate("backend/index/index");
		return $viewModel;
	}
	public function installAction() {
		
		$viewModel = new ViewModel (); 
		 
		$viewModel->setTemplate ( "backend/index/index" );
		return $viewModel;
	}
}
