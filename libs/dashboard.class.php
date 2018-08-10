<?php

	class dashboard
	{
		function getMySQL($config, $alert = false)
		{
			$db = false;
			try {
				$db = new PDO('mysql:host=' . $config['mysql']['mysql_address'] . ';dbname=' . $config['mysql']['mysql_database'], $config['mysql']['mysql_login'], $config['mysql']['mysql_password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $ex) {
				if ($alert) {
					$_SESSION['alert'] = array('message' => '<br><b>Nie udalo sie polaczyc z baza danych!</b><br>' . '<br>Error code: ' . $ex->getCode() . '<br>Error message: ' . $ex->getMessage(), 'type' => 'danger');
				} else {
					die('Nie udalo sie polaczyc z baza danych!' . PHP_EOL . 'Error code: ' . $ex->getCode() . PHP_EOL . 'Error message: ' . $ex->getMessage() . PHP_EOL);
				}
			}
			return $db;
		}
		
		function getOptionList($config)
		{
			$bots = self::getMySQL($config)->query("SELECT * FROM `dashboard_bots`");
			$listCreated = array();
			foreach ($bots as $bot) {
				$listCreated[] = $bot['id'];
			}
			$result = array();
			$result .= '<option selected disabled>[!] Id bota</option>';
			for ($i = 1; $i <= 128; $i++) {
				if (!in_array($i, $listCreated)) {
					$result .= '<option value="' . $i . '">' . $i . '</option>';
				}
			}
			return $result;
		}
	}
