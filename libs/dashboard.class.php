<?php

	class dashboard
	{

		function getMySQL($config)
		{
			$db = null;
			try {
				$db = new PDO('mysql:host=' . $config['mysql']['mysql_address'] . ';dbname=' . $config['mysql']['mysql_database'], $config['mysql']['mysql_login'], $config['mysql']['mysql_password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $ex) {
				die('Nie udalo sie polaczyc z baza danych!' . PHP_EOL . 'Error code: ' . $ex->getCode() . PHP_EOL . 'Error message: ' . $ex->getMessage());
			}
			return $db;
		}

		function setTempCache($file, $type, $value)
		{
			file_put_contents(__DIR__ . '/../cache/temp/' . $file . '_' . $type . '.temp', json_encode($value));
		}

		function setCache($file, $value, $json)
		{
			if ($json) {
				file_put_contents(__DIR__ . '/../cache/' . $file . '.wright', json_encode($value));
			} else {
				file_put_contents(__DIR__ . '/../cache/' . $file . '.wright', $value);
			}
		}

		function getCache($file, $json)
		{
			$cache = '';
			if (file_exists(__DIR__ . '/../cache/' . $file . '.wright')) {
				if ($json) {
					$cache = json_decode(file_get_contents(__DIR__ . '/../cache/' . $file . '.wright'));
				} else {
					$cache = file_get_contents(__DIR__ . '/../cache/' . $file . '.wright');
				}
			}
			return $cache;
		}

		function getOptionList()
		{
			$cache = self::getCache('bots_list', true);
			$listCreated = array();
			foreach ($cache as $bot) {
				$listCreated[] = $bot->id;
			}
			$result = array();
			$result .= '<option selected disabled>Id bota</option>';
			for ($i = 1; $i <= 128; $i++) {
				if (!in_array($i, $listCreated)) {
					$result .= '<option value="'.$i.'">'.$i.'</option>';
				}
			}
			return $result;
		}
	}