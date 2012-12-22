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

use Backend\Form\SectionForm;
use Backend\Form\GalleryForm;
use Backend\Form\ItemForm;
use Zend\Validator\File\Size;

class IndexController extends AbstractActionController {
	protected $em;
	public function setEntityManager(EntityManager $em) {
		$this->em = $em;
	}
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()
					->get('Doctrine\ORM\EntityManager');
		}
		return $this->em;
	}
	public function zerofill($num, $zerofill = 2) {
		return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
	}
	public function indexAction() {
		$viewModel = new ViewModel();
		$secciones = $this->getEntityManager()
				->getRepository('Backend\Entity\Section')->findAll();

		foreach ($secciones as $s) {

			$galerias = $this->getEntityManager()
					->getRepository('Backend\Entity\Gallery')
					->findBy(array('id_section' => $s->getId()));
			unset($galeria);
			foreach ($galerias as $g) {
				$items = $this->getEntityManager()
						->getRepository('Backend\Entity\Item')
						->findBy(array('id_gallery' => $g->getId()));
				unset($item);
				foreach ($items as $it) {
					$item[] = array("path_thumb" => $it->getPath_thumb());
				}

				$galeria[] = array("descripcion" => $g->getDescripcion(),
						"id" => $g->getId(), "items" => $item);
			}

			$sections[] = array("descripcion" => $s->getDescripcion(),
					"id" => $s->getId(), "galerias" => $galeria);
		}

		$vars["dump"] = $galerias;

		$vars["sections"] = $sections;

		$vars["data"] = getcwd() . "/public/_gallery";
		$viewModel->setVariables($vars);
		// $viewModel->setTemplate("backend/index/index");
		return $viewModel;
	}
	public function installAction() {

		$viewModel = new ViewModel();

		$viewModel->setTemplate("backend/index/index");
		return $viewModel;
	}

	public function addAction() {
		//echo getcwd()."/public/_gallery";

		//echo $this->getEvent()->getRouteMatch()->getParam('type');

		if ($this->getEvent()->getRouteMatch()->getParam('type') == "gallery") {
			$form = new GalleryForm();
			$form->add(array('name' => 'id_section',
					'attributes' => array('type' => 'hidden',
							'value' => $this->getEvent()->getRouteMatch()->getParam('id')),));

			echo $this->getEvent()->getRouteMatch()->getParam('id');

		} elseif ($this->getEvent()->getRouteMatch()->getParam('type')	== "item") {
			$form = new ItemForm();
			$form->add(array('name' => 'id_gallery',
					'attributes' => array('type' => 'hidden',
							'value' => $this->getEvent()
							->getRouteMatch()
							->getParam('id')),));

			echo $this->getEvent()->getRouteMatch()->getParam('id');
		} else {
			$form = new SectionForm();
		}

		//return array('form' => $form);

		$viewModel = new ViewModel();

		$viewModel->setVariables(array('form' => $form));

		$request = $this->getRequest();
		if ($request->isPost()) {

			if ($form->getName() == "Item") {
				/******/
				$nonFile = $request->getPost()->toArray();
				$File = $this->params()->fromFiles('fileupload');

				$data = array_merge($nonFile,
						//POST
						array('fileupload' => $File['name']) //FILE...
				);

				//set data post and file ...
				$form->setData($data);
				$size = new Size(array('max' => 2000000));
				$adapter = new \Zend\File\Transfer\Adapter\Http();
				//validator can be more than one...
				$adapter->setValidators(array($size), $File['name']);

				if (!$adapter->isValid()) {
					$dataError = $adapter->getMessages();
					$error = array();
					foreach ($dataError as $key => $row) {
						$error[] = $row;
					} //set formElementErrors
					$form->setMessages(array('fileupload' => $error));
				} else {
					$adapter->setDestination(getcwd() . "/public/_gallery");
					echo $File['name'];
					if ($adapter->receive($File['name'])) {
						//	$profile->exchangeArray($form->getData());
						//	echo 'Profile Name '.$profile->profilename.' upload '.$profile->fileupload;
					}

				}
				/******/
			}

			//good
			//return $this->redirect()->toRoute('backend');

		}

		//$viewModel->setTemplate ( "backend/index/index" );

		return $viewModel;
	}

}
