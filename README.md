# TS3AudioBot-Dashboard-NQ

### Quick links to everything
- [Installing TS3Audiobot](#installing-ts3audiobot)
- [Installing Dashboard](#installing-dashboard)
- [Configuration](#configuration)
- [Teamspeak group permissions](#teamspeak-group-permissions)
- [Requirements](#requirements)
- [Support](#support)
- [Contribute or Donate](#contribution)
- [ScreenShot](#screenshot)
- [License](#license)

### Installing TS3Audiobot
```bash
cd /home
```

```bash
wget https://wright.intcode.pl/dl/TS3AudioBotInstall
```

```bash
chmod 0777 TS3AudioBotInstall
```

```bash
./TS3AudioBotInstall
```

### Installing Dashboard
```bash
cd /var/www/html
```

```bash
wget https://github.com/WrightProjects/TS3AudioBot-Dashboard-NQ/archive/master.zip
```

```bash
unzip master.zip
```

```bash
rm master.zip
```

```bash
mv TS3AudioBot-Dashboard-NQ-master TS3AudioBot-Dashboard
```

```bash
cd TS3AudioBot-Dashboard
```

```bash
echo 'www-data ALL=NOPASSWD: ALL' >> /etc/sudoers
```

```bash
Import TS3AudioBot.sql to your database.
```

Nice! Go to [Configuration](#configuration).

### Configuration
- The configuration file is located in /var/www/html/TS3AudioBot-Dashboard/settings/config.php
- Configuration is pretty simple!
- GL!
```php
<?php

	$config['mysql'] = array(
		'mysql_address' => 'localhost',
		'mysql_login' => 'root',
		'mysql_password' => 'anonymous',
		'mysql_database' => 'database'
	);

	$config['global'] = array(
		'bots_list_refresh' => 5, //Best interval: 60
		'ajax_secretKey' => 'xyz' //Random key for tsWebSite (COMMING SOON)
	);
```

### Teamspeak group permissions

* ts3audiobot_bot_group:
```
b_virtualserver_client_list
b_virtualserver_channel_list
b_client_use_channel_commander
b_client_ignore_antiflood
b_client_ignore_bans
i_client_max_avatar_filesize
i_client_max_channel_subscriptions
i_channel_subscribe_power
```

### Requirements
* PHP 5.6+
* MySQL Server

### Support
* [PogadajTu.PL](https://pogadajtu.pl) - TeamSpeak server
* [TsForum.PL](https://tsforum.pl/temat/3729-prosty-panel-dla-aplikacji-ts3audiobot-🎶/) - Forum topic
* Wright@ogarnij.se - Email

### Contribution
* Yes, of course you can contribute in `TS3AudioBot-Dashboard`!
* Either helping with code, or supporting the project with donation!
* Donate: [paypal.me/WrightPP](paypal.me/WrightPP)

### ScreenShot
![ScreenShot](https://i.imgur.com/YbKLMEu.png)

### License
* [General Public License v3.0](https://github.com/WrightProjects/TS3AudioBot-Dashboard-NQ/blob/master/LICENSE)
