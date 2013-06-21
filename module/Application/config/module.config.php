<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

return array (
    'router' => array (
        'routes' => array (
            'home' => array (
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array (
                    'route' => '/',
                    'defaults' => array (
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index' 
                    ) 
                ) 
            ),
            // The following is a route to simplify getting started
            // creating
            // new controllers and actions without needing to create
            // a new
            // module. Simply drop new controllers in, and you can
            // access them
            // using the path /application/:controller/:action
            
            'aboutus' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/aboutus',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Application\Controller\Index',
                        'action' => 'aboutus' 
                    ) 
                ) 
            ),
            
            'clients' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/clients',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Application\Controller\Index',
                        'action' => 'clients' 
                    ) 
                ) 
            ),
            
            'contactus' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/contactus',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Application\Controller\Index',
                        'action' => 'contactus' 
                    ) 
                ) 
            ),
            
            'language' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/language',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Application\Controller\Index',
                        'action' => 'language' 
                    ) 
                ),
                'may_terminate' => true,
                'child_routes' => array (
                    'default' => array (
                        'type' => 'Segment',
                        'options' => array (
                            'route' => '/[:lang]',
                            'constraints' => array (
                                'lang' => '[a-zA-Z][a-zA-Z0-9_-]*' 
                            ),
                            'defaults' => array () 
                        ) 
                    ) 
                ) 
            ),
            
            'projects' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/projects',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Projects',
                        'action' => 'index' 
                    ) 
                ),
                'may_terminate' => true,
                'child_routes' => array (
                    'default' => array (
                        'type' => 'Segment',
                        'options' => array (
                            'route' => '/[:section[/[:id[/[:galeria]]]]]',
                            'constraints' => array (
                                'galeria' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'section' => '[a-zA-Z][a-zA-Z0-9_-]*' 
                            ),
                            'defaults' => array (
                                '__NAMESPACE__' => 'Application\Controller',
                                'controller' => 'Projects',
                                'action' => 'landing' 
                            ) 
                        ) 
                    ) 
                ) 
            ),
            
            'stands' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/stands',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Stands',
                        'action' => 'index' 
                    ) 
                ),
                'may_terminate' => true,
                'child_routes' => array (
                    'default' => array (
                        'type' => 'Segment',
                        'options' => array (
                            'route' => '/[:action[/[:gallery]]]',
                            'constraints' => array (
                                'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'gallery' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array (
                              'action' => 'proyectos'
                            ) 
                        ) 
                    ) 
                ) 
            ),
            
            'application' => array (
                'type' => 'Literal',
                'options' => array (
                    'route' => '/application',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index' 
                    ) 
                ),
                'may_terminate' => true,
                'child_routes' => array (
                    
                    'default' => array (
                        'type' => 'Segment',
                        'options' => array (
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array (
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*' 
                            ),
                            'defaults' => array () 
                        ) 
                    ) 
                ) 
            ) 
        ) 
    ),
    'service_manager' => array (
        'factories' => array (
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory' 
        ) 
    ),
    'translator' => array (
        'locale' => 'es_ES',
        'translation_file_patterns' => array (
            array (
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo' 
            ) 
        ) 
    ),
    'controllers' => array (
        'invokables' => array (
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Stands' => 'Application\Controller\StandsController',
            'Application\Controller\Projects' => 'Application\Controller\ProjectsController',
            'Application\Controller\Standsx' => 'Application\Controller\StandsxController' 
        ) 
    ),
    'view_manager' => array (
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array (
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'projects/landing' => __DIR__ . '/../view/application/projects/landing.phtml',
            'projects/gallery' => __DIR__ . '/../view/application/projects/gallery.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml' 
        ),
        'template_path_stack' => array (
            __DIR__ . '/../view' 
        ),
        'strategies' => array (
            'ViewJsonStrategy' 
        ) 
    ),
    'doctrine' => array (
        'driver' => array (
            'Application' . '_driver' => array (
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array (
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity' 
                ) 
            ),
            'orm_default' => array (
                'drivers' => array (
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver' 
                ) 
            ) 
        ) 
    ) 
);
