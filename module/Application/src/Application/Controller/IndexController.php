<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\View\View;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Version\Version;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController {
	public function languageAction() {
		
		
		
		
		$session = new Container ( 'base' );
		// $session->offsetSet ( 'language', "es_ES" );
		//$session->offsetSet ( 'language', "en_US" );
		
		$session->offsetSet ( 'language', $this->getEvent ()->getRouteMatch ()->getParam ( 'lang' ) );
		
		$result = new JsonModel ( array (
				// 'language' => substr ( $_SERVER ['HTTP_ACCEPT_LANGUAGE'], 0,
				// 2 ),
				'language' => $session->offsetGet ( 'language' ),
				'success' => true 
		) );
		
		return $result;
	}
	public function indexAction() {
		$config = $this->getServiceLocator ()->get ( 'Config' );
		
		// Setup SMTP transport using LOGIN authentication
		$transport = new SmtpTransport ();
		$options = new SmtpOptions ( array (
				'name' => 'gmail',
				"host" => "smtp.gmail.com",
				"port" => 587,
				"connection_class" => "plain",
				"connection_config" => array (
						"username" => "itsudatte01@gmail.com",
						"password" => "noeliabelen",
						"ssl" => "tls" 
				) 
		) );
		$transport->setOptions ( $options );
		
		$message = new Message ();
		
		$message->addFrom ( "cesar@tineo.mobi", "Tineo" )->addTo ( "itsudatte01@gmail.com" )->setSubject ( "Sending an email from Zend\Mail!" );
		$message->setBody ( "This is the message body." );
		$message->setEncoding ( "UTF-8" );
		
		$transport = new SmtpTransport ();
		$transport->setOptions ( $options );
		
		// $transport->send($message);
		
		// $translator = $this->getServiceLocator ()->get ( 'translator' );
		// $translator->setLocale ( "en_US" );
		// $config['translator']['locale'] = "En_US" ;
		// var_dump($config['translator']['locale']);
		
		return new ViewModel ();
	}
	public function aboutusAction() {
		return new ViewModel ();
	}
	public function contactusAction() {
		return new ViewModel ();
	}
	public function clientsAction() {
		return new ViewModel ();
	}
	public function peruretailAction() {
		
		// obtener la ultimas noticias de peru retail
		$some_link = 'http://www.peru-retail.com/';
		$tagName = 'div';
		$attrName = 'class';
		$attrValue = 'blog_item';
		function getTags($dom, $tagName, $attrName, $attrValue) {
			$html = '';
			$domxpath = new \DOMXPath ( $dom );
			$newDom = new \DOMDocument ();
			$newDom->formatOutput = true;
			$filtered = $domxpath->query ( "//$tagName" . '[@' . $attrName . "='$attrValue']" );
			$i = 0;
			while ( $myItem = $filtered->item ( $i ++ ) ) {
				$node = $newDom->importNode ( $myItem, true );
				$newDom->appendChild ( $node );
			}
			$html = $newDom->saveHTML ();
			return $html;
		}
		
		$dom = new \DOMDocument ();
		$dom->preserveWhiteSpace = false;
		@$dom->loadHTMLFile ( $some_link );
		
		$html = getTags ( $dom, $tagName, $attrName, utf8_decode ( $attrValue ) );
		
		echo $html;
		$viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
	}
}
