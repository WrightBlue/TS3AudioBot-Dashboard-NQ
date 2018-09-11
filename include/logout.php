<?php
	if (empty($_SESSION['user_online'])) {
		session_unset();
		$_SESSION['alert'] = array('message' => 'Wylogowano pomyślnie!', 'type' => 'success');
		exit(header('Location: ?login'));
	}

	header('Location: ?login');
