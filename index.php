<?php
	session_start();
	$include = '';
	foreach ($_REQUEST as $key => $value) {
		$include = __DIR__ . '/include/' . $key . '.php';
		$_SESSION['PAGE_REQUEST'] = $key;
		break;
	}
	if (file_exists($include)) {
		require_once __DIR__ . '/settings/config.php';
		require_once __DIR__ . '/libs/dashboard.class.php';
		$dashboard = new dashboard();
		require_once __DIR__ . '/include/header.php';
		require_once $include;
	} else {
		header('Location: ?dashboard');
		exit();
	}
	require_once __DIR__ . '/include/footer.php';