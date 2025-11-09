-- Init DB for PonyMVC
CREATE DATABASE IF NOT EXISTS `ponymvc` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ponymvc`;

CREATE TABLE IF NOT EXISTS `ponies` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `src` VARCHAR(255) NOT NULL,
  `alt` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `ponies` (`src`, `alt`) VALUES
('https://derpicdn.net/img/view/2016/10/5/1265518.gif', 'twilight sparkle'),
('https://derpicdn.net/img/view/2012/9/21/103095.gif', 'fluttershy'),
('https://derpicdn.net/img/view/2015/8/16/959136.gif', 'applejack'),
('https://derpicdn.net/img/view/2019/11/4/2187209.png', 'rainbow dash'),
('https://derpicdn.net/img/view/2015/8/14/957501.gif', 'pinkie pie'),
('https://derpicdn.net/img/view/2014/2/12/549799.gif', 'rarity');