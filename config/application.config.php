<?php
return array (
		'modules' => array (
				'EdpModuleLayouts',
				'Application',
				'Backend',
				'DoctrineModule',
				'DoctrineORMModule' 
		),
		'module_listener_options' => array (
				'config_glob_paths' => array (
						'config/autoload/{,*.}{global,local}.php' 
				),
				'module_paths' => array (
						'./module',
						'./vendor' 
				) 
		),
		'module_layouts' => array (
				'Application' => 'layout/layout',
				'Backend' => 'layout/backend' 
		) 
);
