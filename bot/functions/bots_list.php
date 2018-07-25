<?php
	class bots_list {

		function run($db, $config, $dashboard) {
			$bots = $db->query("SELECT * FROM `dashboard_bots`");
			$cache = array();
			foreach ($bots as $bot) {
				$status = 'Wyłączony';
				$color = '#ffbcb7';
				if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AudioBot".$bot['id']." -Q select . ; echo $?")) == '0') {
					$status = 'Właczony';
					$color = '#baffb2';
				}
				array_push($cache, array(
					'id' => $bot['id'],
					'name' => $bot['name'],
					'server' => $bot['server'],
					'channel' => $bot['channel'],
					'group' => $bot['group'],
					'status' => $status,
					'color' => $color
				));
			}
			$dashboard->setCache('bots_list', $cache, true);
		}
	}