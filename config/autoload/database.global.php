<?php
/*return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'db' => array(
        'driver'    => 'pdo',
        'dsn'       => 'mysql:dbname=CHANGEME;host=localhost',
        'username'  => 'CHANGEME',
        'password'  => 'CHANGEME',
    ),
);*/

/*return array(
		'service_manager' => array(
				'factories' => array(
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
				),
		),
		'db' => array(
				'driver'   => 'pdo',
				'dsn'      => 'sqlite:' . getcwd() . '/data/users.db',
		)
);*/

return array(
		'doctrine' => array(
				'connection' => array(
						'orm_default' => array(
								'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
								'params' => array(
										'host'     => 'db406176747.db.1and1.com',
										'port'     => '3306',
										'user'     => 'dbo406176747',
										'password' => 'a20062161',
										'dbname'   => 'db406176747'
								)
						)
				)
		),
);