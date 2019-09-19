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
wget https://files.wright.blue/old/dl/TS3AudioBotInstall.sh --no-check-certificate
```

```bash
chmod 0777 TS3AudioBotInstall.sh
```

```bash
./TS3AudioBotInstall.sh
```

### Installing PHP 7.2 + PDO and Apache2 + mod_rewrite
```bash
apt-get install apache2
```

```bash
echo "<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    allow from all
</Directory>" >> /etc/apache2/sites-available/000-default.conf
```

```bash
a2enmod rewrite
```

```bash
service apache2 restart
```

```bash
apt-get install apt-transport-https lsb-release ca-certificates
```

```bash
add-apt-repository ppa:ondrej/php
```

```bash
apt-get update
```

```bash
apt-get install php7.2 php7.2-pdo
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
mv TS3AudioBot-Dashboard-NQ-master TS3AB-DA-FREE
```

```bash
echo 'www-data ALL=NOPASSWD: ALL' >> /etc/sudoers
```

```bash
Import /var/www/html/TS3AB-DA-FREE/database.sql to your database.
```

Nice! Go to [Configuration](#configuration).

### Configuration
- Open /var/www/html/TS3AB-DA-FREE/application/config/config.php
- Find and change:
```php
$config['base_url'] = 'http://127.0.0.1/TS3AB-DA-FREE/';
```
- Open and edit /var/www/html/TS3AB-DA-FREE/application/config/database.php
- Open and edit /var/www/html/TS3AB-DA-FREE/application/config/dashboard.php

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
* PHP +5.6 + PDO
* MySQL Server
* Apache2 + mod_rewrite

### Support
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
