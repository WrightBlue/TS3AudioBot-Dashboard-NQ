<?php
	if ($_SESSION['user_online']) {
		session_unset();
		$_SESSION['alert'] = array('message' => 'Wylogowano pomyślnie!', 'type' => 'success');
		header('Location: ?login');
		exit();
	}

	header('Location: ?login');