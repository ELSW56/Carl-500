-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 16 Septembre 2015 à 12:48
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `carl500_new_v1`
--

-- --------------------------------------------------------

--
-- Structure de la vue `vue_timeline`
--
--V1 : obsolète
CREATE  VIEW `vue_timeline` AS 
select 	`d`.`id` AS `id`,
		`r`.`id` AS `id_run`,
		date_format((`w1`.`date_heure_depart` - interval 1 month),'%Y,%m,%d,%H,%i') AS `depart`,
		date_format((`w2`.`date_heure_arrivee` - interval 1 month),'%Y,%m,%d,%H,%i') AS `arrivee`,
		`b`.`name` AS `band`,
		if(isnull(`p`.`id`),-1,`p`.`id`) AS `driver`,
		if(isnull(`c`.`id`),-1,`c`.`id`) AS `car`,
		if((`r`.`status` = 1),'white',if((`r`.`calle` = 1),'green','red')) AS `statut` 
from 	((((((`run` `r` join `way` `w1` on((`r`.`id` = `w1`.`id_run`))) 
		join `way` `w2` on((`r`.`id` = `w2`.`id_run`))) 
		left join `drive` `d` on((`r`.`id` = `d`.`id_run`))) 
		left join `car` `c` on((`d`.`id_car` = `c`.`id`))) 
		left join `people` `p` on((`d`.`id_driver` = `p`.`id`))) 
		join `band` `b` on((`r`.`id_band` = `b`.`id`))) 
where ((`w1`.`date_heure_depart` = (
			select min(`way`.`date_heure_depart`) 
			from `way` 
			where (`way`.`id_run` = `r`.`id`))) 
and (`w2`.`date_heure_depart` = (
			select max(`way`.`date_heure_depart`) 
			from `way` where (`way`.`id_run` = `r`.`id`))))
;

-- V2 : plus simple et appliquable avec les changements dans la table drive
CREATE VIEW vue_timeline AS
select 	`d`.`id` AS `id`,
		`r`.`id` AS `id_run`,
		date_format((`d`.`start` - interval 1 month),'%Y,%m,%d,%H,%i') AS `depart`,
		date_format((`d`.`end` - interval 1 month),'%Y,%m,%d,%H,%i') AS `arrivee`,
		`b`.`name` AS `band`,
		if(isnull(`p`.`id`),-1,`p`.`id`) AS `driver`,
		if(isnull(`c`.`id`),-1,`c`.`id`) AS `car`,
		if((`r`.`status` = 1),'white',if((`r`.`calle` = 1),'green','red')) AS `statut` 
from 	((((`run` `r` left join `drive` `d` on((`r`.`id` = `d`.`id_run`))) 
		left join `car` `c` on((`d`.`id_car` = `c`.`id`))) 
		left join `people` `p` on((`d`.`id_driver` = `p`.`id`))) 
		join `band` `b` on((`r`.`id_band` = `b`.`id`)))
order by r.id, d.id;

--
-- VIEW  `vue_timeline`
-- Données: Aucune
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
