<?php /** @noinspection ALL */

	require_once __DIR__ . "/../settings/config.php";
	require_once __DIR__ . "/../libs/dashboard.class.php";

	define('PREFIX', '  [BOT] >> ');

	echo PHP_EOL.PREFIX.'Logi:'.PHP_EOL;
	$cache = array();
	foreach ($config['functions'] as $function) {
		if ($function['enable']) {
			include_once $function['file'];
			$cache['functions'][$function['name']] = array(
				'interval' => $function['interval'],
				'next_update' => 0
			);
		}
	}
	$dashboard = new dashboard();
	while (true) {
		foreach ($cache['functions'] as $function => $name) {
			if ($cache['functions'][$function]['next_update'] < time()) {
				$function::run($dashboard->getMySQL($config), $config, $dashboard);
				$cache['functions'][$function]['next_update'] = time() + $cache['functions'][$function]['interval'];
			}
		}
		sleep(1);
	}