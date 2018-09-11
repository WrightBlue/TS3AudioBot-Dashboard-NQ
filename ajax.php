<?php

	session_start();

	header('Content-Type: application/json');

	require_once __DIR__ . '/settings/config.php';

	if (!empty($_SESSION['user_online'])) {
		require_once __DIR__ . '/libs/dashboard.class.php';
		$dashboard = new dashboard();
		if ($_POST['request'] == 'start') {
			$botId = $_POST['botId'];
			if (isset($botId)) {
				if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AudioBot" . base64_encode($botId) . " -Q select . ; echo $?")) != '0') {
					shell_exec("sudo screen -AdmS TS3AudioBot" . base64_encode($botId) . " mono /home/TS3AudioBot/TS3AudioBot.exe -c /home/TS3AudioBot/config/" . $botId . ".cfg");
					printJson('success', 'Wlaczono bota o id ' . $botId . '!');
				} else {
					printJson('warning', 'Proba wlaczenia bota id ' . $botId . ' nie powiodla sie (Bot jest juz wlaczony)');
				}
			} else {
				printJson('danger', 'botId???');
			}
		} else if ($_POST['request'] == 'stop') {
			$botId = $_POST['botId'];
			if (isset($botId)) {
				if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AudioBot" . base64_encode($botId) . " -Q select . ; echo $?")) != '0') {
					printJson('warning', 'Proba wylaczenia bota id ' . $botId . ' nie powiodla sie (Bot jest juz wylaczony)');
				} else {
					shell_exec("sudo screen -S TS3AudioBot" . base64_encode($botId) . " -p 0 -X stuff ^C");
					printJson('success', 'Wylaczono bota o id ' . $botId . '!');
				}
			} else {
				printJson('danger', 'botId???');
			}
		} else if ($_POST['request'] == 'delete') {
			$botId = $_POST['botId'];
			if (isset($botId)) {
				$db = $dashboard->getMySQL($config);
				$db->prepare("DELETE FROM `dashboard_bots` WHERE id=" . $botId)->execute();
				printJson('success', 'Usunieto bota o id ' . $botId . '!');
			} else {
				printJson('danger', 'botId???');
			}
		} else if ($_POST['request'] == 'create') {
			$botId = $_POST['botId'];
			$name = $_POST['name'];
			$channel = $_POST['channel'];
			$server = $_POST['server'];
			$group = $_POST['group'];
			$leave_message = $_POST['leave_message'];
			$avatar = $_POST['avatar'];
			$music_message = $_POST['music_message'];
			$db = $dashboard->getMySQL($config);
			if (!empty($botId) && !empty($name) && !empty($channel) && !empty($server) && !empty($group) && !empty($leave_message)) {
				$commands = array(
					"sudo sed -i '69s/.*/QueryConnection::DefaultNickname=" . $name . "/' /home/TS3AudioBot/config/" . $botId . ".cfg",
					"sudo sed -i '72s\.*\QueryConnection::DefaultChannel=/" . $channel . "\' /home/TS3AudioBot/config/" . $botId . ".cfg",
					"sudo sed -i '45s/.*/QueryConnection::Address=" . $server . "/' /home/TS3AudioBot/config/" . $botId . ".cfg",
					"sudo sed -i '10s/.*/    groupid = [ " . $group . " ]/' /home/TS3AudioBot/permissions/" . $botId . ".toml",
					"sudo sed -i '88s/.*/QueryConnection::CustomDisconnectMessage=" . $leave_message . "/' /home/TS3AudioBot/config/" . $botId . ".cfg"
				);
				if ($db->query("SELECT * FROM `dashboard_bots` WHERE `id`=" . $botId)->fetch(PDO::FETCH_ASSOC) == false) {
					$db->prepare("INSERT INTO `dashboard_bots` (`id`, `name`, `server`, `group`, `channel`) VALUES ('" . $botId . "', '" . $name . "', '" . $server . "', '" . $group . "', '" . $channel . "')")->execute();
					foreach ($commands as $cmd) {
						shell_exec($cmd);
					}
					if (!empty($avatar)) {
						shell_exec("sudo sed -i '18s/.*/MainBot::GenerateStatusAvatar=False/' /home/TS3AudioBot/config/" . $botId . ".cfg");
						shell_exec("sudo sed -i '80s\.*\MainBot::CustomAvatar=" . $avatar . "\' /home/TS3AudioBot/config/" . $botId . ".cfg");
					}
					if (!empty($music_message)) {
						shell_exec("sudo sed -i '84s/.*/MainBot::EnableMusicChannelInfo=True/' /home/TS3AudioBot/config/" . $botId . ".cfg");
						shell_exec("sudo sed -i '86s/.*/MainBot::MusicChannelInfo=" . $music_message . "/' /home/TS3AudioBot/config/" . $botId . ".cfg");
					}
					printJson('success', 'Stworzono bota o id ' . $botId . '!');
				} else {
					$db->prepare("UPDATE `dashboard_bots` SET `name`='" . $name . "', `channel`='" . $channel . "', `server`='" . $server . "', `group`='" . $group . "' WHERE id=" . $botId)->execute();
					foreach ($commands as $cmd) {
						shell_exec($cmd);
					}
					if (!empty($avatar)) {
						shell_exec("sudo sed -i '18s/.*/MainBot::GenerateStatusAvatar=False/' /home/TS3AudioBot/config/" . $botId . ".cfg");
						shell_exec("sudo sed -i '80s\.*\MainBot::CustomAvatar=" . $avatar . "\' /home/TS3AudioBot/config/" . $botId . ".cfg");
					}
					if (!empty($music_message)) {
						shell_exec("sudo sed -i '84s/.*/MainBot::EnableMusicChannelInfo=True/' /home/TS3AudioBot/config/" . $botId . ".cfg");
						shell_exec("sudo sed -i '86s/.*/MainBot::MusicChannelInfo=" . $music_message . "/' /home/TS3AudioBot/config/" . $botId . ".cfg");
					}
					printJson('success', 'Zmieniono ustawienia bota o id ' . $botId . '!');
				}
			} else {
				printJson('danger', 'Pola oznaczone <b>[!]</b> muszą być wypełnione!');
			}
		} else if ($_POST['request'] == 'bots') {
			$db = $dashboard->getMySQL($config);
			$bots = $db->query("SELECT * FROM `dashboard_bots`");
			$cache = array();
			foreach ($bots as $bot) {
				$status = 'Wyłączony';
				$color = '#ffbcb7';
				if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AudioBot" . base64_encode($bot['id']) . " -Q select . ; echo $?")) == '0') {
					$status = 'Właczony';
					$color = '#baffb2';
				}
				array_push($cache, array('id' => $bot['id'], 'name' => $bot['name'], 'server' => $bot['server'], 'channel' => $bot['channel'], 'group' => $bot['group'], 'status' => $status, 'color' => $color));
			}
			printJson('success', $cache);
		} else {
			printJson('danger', 'request???');
		}
	} else {
		printJson('danger', 'Brak autoryzacji!');
	}

	function printJson($type, $message)
	{
		echo json_encode(array('type' => $type, 'message' => $message));
	}
