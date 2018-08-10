SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `dashboard_auth` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `dashboard_auth` (`id`, `login`, `password`) VALUES
(0, 'admin', 'foobar');

CREATE TABLE IF NOT EXISTS `dashboard_bots` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `server` text COLLATE utf8_polish_ci NOT NULL,
  `group` text COLLATE utf8_polish_ci NOT NULL,
  `channel` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

ALTER TABLE `dashboard_auth`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `dashboard_bots`
 ADD PRIMARY KEY (`id`);
