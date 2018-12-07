<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot extends CI_Controller
{

    public function create()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if (!$this->session->userdata('logged')) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_logged']));
        }
        $id = getRandomString();
        $name = $this->input->post('name');
        $channel = $this->input->post('channel');
        $server = $this->input->post('server');
        $rights = $this->input->post('rights');
        if (empty($name) || empty($channel) || empty($server) || empty($rights)) {
            return $this->output->set_output(printJson(false, 'Wypełnij wszystkie pola!'));
        }
        $cfg = '# A space seperated list of all urls the web api should be possible to be accessed with
WebData::HostAddress=
# The port for the api server
WebData::Port=8180
# If you want to start the web api server.
WebData::EnableApi=False
# If you want to start the webinterface server
WebData::EnableWebinterface=False
# The folder to host. Leave empty to let the bot look for default locations.
WebData::WebinterfaceHostPath=
# Path to the config file
RightsManager::RightsFile=/home/TS3AudioBot-FREE/permissions/'.$id.'.toml
# The language the bot should use to respond to users. (Make sure you have added the required language packs)
MainBot::Language=pl
# Teamspeak group id giving the Bot enough power to do his job
MainBot::BotGroupId=0
# Generate fancy status images as avatar
MainBot::GenerateStatusAvatar=True
# Defines how the bot tries to match your !commands.
# Possible types: exact, substring, ic3, hamming
MainBot::CommandMatching=exact
# A youtube apiv3 \'Browser\' type key
YoutubeFactory::ApiKey=AIzaSyBTzXEErqKJb-zm5lVPmcnlkdyfilFEQLs
# Path to the youtube-dl binary or local git repository
YoutubeFactory::YoutubedlPath=/usr/local/bin/youtube-dl
# The absolute or relative path to the plugins folder
PluginManager::PluginPath=/home/TS3AudioBot-FREE/Plugins
# Write to .status files to store a plugin enable status persistently and restart them on launch.
PluginManager::WriteStatusFiles=True
# The default path to look for local resources.
MediaFactory::DefaultPath=/home/TS3AudioBot-FREE
# Allows to enable or disable history features completely to save resources.
HistoryManager::EnableHistory=True
# The Path to the history database file
HistoryManager::HistoryFile=/home/TS3AudioBot-FREE/history.db
# Whether or not deleted history ids should be filled up with new songs
HistoryManager::FillDeletedIds=True
# The default volume a song should start with
AudioFramework::DefaultVolume=10
# The maximum volume a normal user can request
AudioFramework::MaxUserVolume=100
# How the bot should play music. Options are: whisper, voice, (!...)
AudioFramework::AudioMode=voice
# The address (and port, default: 9987) of the TeamSpeak3 server
QueryConnection::Address='.$server.'
# | DO NOT MAKE THIS KEY PUBLIC | The client identity
QueryConnection::Identity=
# The client identity security offset
QueryConnection::IdentityOffset=203
# The client identity security level which should be calculated before connecting, or "auto" to generate on demand.
QueryConnection::IdentityLevel=auto
# The server password. Leave empty for none.
QueryConnection::ServerPassword=
# Set this to true, if the server password is hashed.
QueryConnection::ServerPasswordIsHashed=False
# Enable this to automatically hash and store unhashed passwords.
# (Be careful since this will overwrite the \'ServerPassword\' field with the hashed value once computed)
QueryConnection::ServerPasswordAutoHash=False
# The path to ffmpeg
QueryConnection::FfmpegPath=ffmpeg
# Specifies the bitrate (in kbps) for sending audio.
# Values between 8 and 98 are supported, more or less can work but without guarantees.
# Reference values: 32 - ok (~5KiB/s), 48 - good (~7KiB/s), 64 - very good (~9KiB/s), 92 - superb (~13KiB/s)
QueryConnection::AudioBitrate=92
# Version for the client in the form of <version build>|<platform>|<version sign>
# Leave empty for default.
QueryConnection::ClientVersion=3.1.10 [Build: 1528537615]|Linux|jEfjYy09JfbJPZ+W3fwqygOu8uuc5raYTGpbJ5F8dHLHpqUfvmCyJVKoXRieMNkmPzeiylsUc9/HiV+8bt8tDw==
# Default Nickname when connecting
QueryConnection::DefaultNickname='.$name.'
# Default Channel when connectiong
# Use a channel path or \'/<id>\', examples: \'Home/Lobby\', \'/5\', \'Home/Afk \/ Not Here\'
QueryConnection::DefaultChannel=/'.$channel.'
# The password for the default channel. Leave empty for none. Not required with permission b_channel_join_ignore_password
QueryConnection::DefaultChannelPassword=
# The client badges. You can set a comma seperate string with max three GUID\'s. Here is a list: http://yat.qa/ressourcen/abzeichen-badges/
QueryConnection::ClientBadges=overwolf=0:badges=
# Path the playlist folder
PlaylistManager::PlaylistPath=/home/TS3AudioBot-FREE/Music
# Custom Avatar image url or /home/TS3AudioBot-FREE/Avatars/avatar.png
MainBot::CustomAvatar=http://via.placeholder.com/300x300&text=TSFORUM.PL
# Enable channel commander on join
MainBot::AutoChannelCommander=True
# Enable Music channel info
MainBot::EnableMusicChannelInfo=False
# Music channel info
MainBot::MusicChannelInfo=[b]Teraz gram: %SONG
# Custom disconnect message
QueryConnection::CustomDisconnectMessage=Polski Support TeamSpeak - tsforum.pl';
        file_put_contents("/home/TS3AudioBot-FREE/config/$id.cfg", $cfg);
        file_put_contents("/home/TS3AudioBot-FREE/permissions/$id.toml", $rights);
        $this->db->query("INSERT INTO `dashboard_bots` (`id`, `name`, `server`, `channel`) VALUES ('$id', '".htmlspecialchars($name)."', '$server', '$channel')");
        shell_exec("sudo screen -AdmS TS3AB-BOT-$id mono /home/TS3AudioBot-FREE/TS3AudioBot.exe -c /home/TS3AudioBot-FREE/config/$id.cfg");
        return $this->output->set_output(printJson(true, 'Stworzono bota!'));
    }

    public function bots()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if (!$this->session->userdata('logged')) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_logged']));
        }
        $bots = $this->db->query("SELECT * FROM `dashboard_bots`")->result_array();
        $list = array();
        foreach ($bots as $bot) {
            $status = 'Offline';
            $color = '#ffbcb7';
            if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AB-BOT-" . $bot['id'] . " -Q select . ; echo $?")) == '0') {
                $status = 'Online';
                $color = '#baffb2';
            }
            array_push($list, array('id' => $bot['id'], 'name' => $bot['name'], 'server' => $bot['server'], 'channel' => $bot['channel'], 'status' => $status, 'color' => $color));
        }
        return $this->output->set_output(json_encode($list));
    }

    public function start()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if (!$this->session->userdata('logged')) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_logged']));
        }
        $id = $this->input->post('id');
        if (empty($id)) {
            return $this->output->set_output(printJson(false, 'id?'));
        }
        if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AB-BOT-$id -Q select . ; echo $?")) != '0') {
            shell_exec("sudo screen -AdmS TS3AB-BOT-$id mono /home/TS3AudioBot-FREE/TS3AudioBot.exe -c /home/TS3AudioBot-FREE/config/$id.cfg");
            return $this->output->set_output(printJson(true, 'Wlaczono bota'));
        }
        return $this->output->set_output(printJson(false, 'Bot jest juz wlaczony'));
    }

    public function stop()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if (!$this->session->userdata('logged')) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_logged']));
        }
        $id = $this->input->post('id');
        if (empty($id)) {
            return $this->output->set_output(printJson(false, 'id?'));
        }
        if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AB-BOT-$id -Q select . ; echo $?")) != '0') {
            return $this->output->set_output(printJson(false, 'Bot jest juz wylaczony'));
        }
        shell_exec("sudo screen -S TS3AB-BOT-$id  -p 0 -X stuff ^C");
        return $this->output->set_output(printJson(true, 'Wylaczono bota'));
    }

    public function delete()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if (!$this->session->userdata('logged')) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_logged']));
        }
        $id = htmlspecialchars($this->input->post('id'));
        if (empty($id)) {
            return $this->output->set_output(printJson(false, 'id?'));
        }
        if (preg_replace('/\D/', '', shell_exec("sudo screen -S TS3AB-BOT-$id -Q select . ; echo $?")) == '0') {
            shell_exec("sudo screen -S TS3AB-BOT-$id  -p 0 -X stuff ^C");
        }
        unlink("/home/TS3AudioBot-FREE/config/$id.cfg");
        unlink("/home/TS3AudioBot-FREE/permissions/$id.toml");
        $this->db->query("DELETE FROM `dashboard_bots` WHERE `id`='$id'");
        return $this->output->set_output(printJson(true, 'Usunieto bota'));
    }

    public function edit()
    {
        $this->output->set_content_type('application/json')->set_status_header(200);
        if (!$this->session->userdata('logged')) {
            return $this->output->set_output(printJson(false, $this->config->item('lang')['login_api_logged']));
        }
        $id = htmlspecialchars($this->input->post('id'));
        if (empty($id)) {
            return $this->output->set_output(printJson(false, 'id?'));
        }
        $file = $this->input->post('file');
        if ($file == 'cfg') {
            file_put_contents("/home/TS3AudioBot-FREE/config/$id.cfg", $this->input->post('data'));
            return $this->output->set_output(printJson(true, 'Zapisano plik'));
        } else {
            file_put_contents("/home/TS3AudioBot-FREE/permissions/$id.toml", $this->input->post('data'));
            return $this->output->set_output(printJson(true, 'Zapisano plik'));
        }
    }
}