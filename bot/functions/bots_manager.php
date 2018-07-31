<?php
	class bots_manager {

		function run($db, $config, $dashboard) {
			foreach (glob(__DIR__."/../../cache/temp/*_create.temp") as $file) {
				$cache = json_decode(file_get_contents($file));
				if ($db->query("SELECT * FROM `dashboard_bots` WHERE `id`=$cache->bot_id")->fetch(PDO::FETCH_ASSOC) == false) {
					$db->prepare("INSERT INTO `dashboard_bots` (`id`, `name`, `server`, `group`, `channel`) VALUES ('".$cache->bot_id."', '".$cache->bot_name."', '".$cache->server."', '".$cache->group."', '".$cache->channel."')")->execute();
					shell_exec("sudo sed -i '69s/.*/QueryConnection::DefaultNickname=" . $cache->bot_name . "/' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
					shell_exec("sudo sed -i '72s\.*\QueryConnection::DefaultChannel=/" . $cache->channel . "\' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
					shell_exec("sudo sed -i '45s/.*/QueryConnection::Address=" . $cache->server . "/' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
					shell_exec("sudo sed -i '10s/.*/    groupid = [ " . $cache->group . " ]/' /home/TS3AudioBot/permissions/" . $cache->bot_id . ".toml");
					if (!empty($cache->avatar)) {
						shell_exec("sudo sed -i '18s/.*/MainBot::GenerateStatusAvatar=False/' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
						shell_exec("sudo sed -i '80s\.*\MainBot::CustomAvatar=" . $cache->avatar . "\' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
					}
					if (!empty($cache->music_message)) {
						shell_exec("sudo sed -i '84s/.*/MainBot::EnableMusicChannelInfo=True/' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
						shell_exec("sudo sed -i '86s/.*/MainBot::MusicChannelInfo=" . $cache->music_message . "/' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
					}
					shell_exec("sudo sed -i '88s/.*/QueryConnection::CustomDisconnectMessage=" . $cache->leave_message . "/' /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
				}
				unlink($file);
			}
			foreach (glob(__DIR__."/../../cache/temp/*_edit.temp") as $file) {
				$cache = json_decode(file_get_contents($file));
				$db->prepare("UPDATE `dashboard_bots` SET `name`='".$cache->name."', `channel`='".$cache->channel."', `server`='".$cache->server."', `group`='".$cache->group."' WHERE id=".$cache->id)->execute();
				shell_exec("sudo sed -i '69s/.*/QueryConnection::DefaultNickname=" . $cache->name . "/' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
				shell_exec("sudo sed -i '72s\.*\QueryConnection::DefaultChannel=/" . $cache->channel . "\' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
				shell_exec("sudo sed -i '45s/.*/QueryConnection::Address=" . $cache->server . "/' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
				shell_exec("sudo sed -i '10s/.*/    groupid = [ " . $cache->group . " ]/' /home/TS3AudioBot/permissions/" . $cache->id . ".toml");
				if (!empty($cache->avatar)) {
					shell_exec("sudo sed -i '18s/.*/MainBot::GenerateStatusAvatar=False/' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
					shell_exec("sudo sed -i '80s\.*\MainBot::CustomAvatar=" . $cache->avatar . "\' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
				}
				if (!empty($cache->music_message)) {
					shell_exec("sudo sed -i '84s/.*/MainBot::EnableMusicChannelInfo=True/' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
					shell_exec("sudo sed -i '86s/.*/MainBot::MusicChannelInfo=" . $cache->music_message . "/' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
				}
				shell_exec("sudo sed -i '88s/.*/QueryConnection::CustomDisconnectMessage=" . $cache->leave_message . "/' /home/TS3AudioBot/config/" . $cache->id . ".cfg");
				unlink($file);
			}
			foreach (glob(__DIR__."/../../cache/temp/*_start.temp") as $file) {
				$cache = json_decode(file_get_contents($file));
				if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AudioBot".$cache->bot_id." -Q select . ; echo $?")) != '0') {
					shell_exec("sudo screen -AdmS TS3AudioBot" . $cache->bot_id . " mono /home/TS3AudioBot/TS3AudioBot.exe -c /home/TS3AudioBot/config/" . $cache->bot_id . ".cfg");
				}
				unlink($file);
			}
			foreach (glob(__DIR__."/../../cache/temp/*_stop.temp") as $file) {
				$cache = json_decode(file_get_contents($file));
				shell_exec("screen -S TS3AudioBot".$cache->bot_id." -p 0 -X stuff ^C");
				unlink($file);
			}
			foreach (glob(__DIR__."/../../cache/temp/*_remove.temp") as $file) {
				$cache = json_decode(file_get_contents($file));
				$db->prepare("DELETE FROM `dashboard_bots` WHERE id=".$cache->bot_id)->execute();
				unlink($file);
			}
			foreach (glob(__DIR__."/../../cache/temp/*_changepass.temp") as $file) {
				$cache = json_decode(file_get_contents($file));
				$db->prepare("UPDATE `dashboard_auth` SET `password`='".$cache->new."' WHERE password='".$cache->old."'")->execute();
				unlink($file);
			}
		}
	}
