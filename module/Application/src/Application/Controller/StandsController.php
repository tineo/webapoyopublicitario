<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\View;
use Zend\View\Model\ViewModel;


class StandsController extends AbstractActionController {
	public function indexAction() {
		return new ViewModel ();
	}
}