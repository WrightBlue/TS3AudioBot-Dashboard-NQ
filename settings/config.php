<?php

	$config['mysql'] = array(
		'mysql_address' => 'localhost',
		'mysql_login' => 'root',
		'mysql_password' => 'anonymous',
		'mysql_database' => 'database'
	);

	$config['functions'] = array(
		1 => array(
			'enable' => true,
			'name' => 'bots_manager',
			'file' => 'functions/bots_manager.php',
			'interval' => 5 //Best interval: 60
		),
		2 => array(
			'enable' => true,
			'name' => 'bots_list',
			'file' => 'functions/bots_list.php',
			'interval' => 5 //Best interval: 60
		),
	);