
CREATE TABLE IF NOT EXISTS `SimpleProjectManagement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bdc` varchar(20) DEFAULT NULL,
  `validation` varchar(40) DEFAULT NULL,
  `ste` varchar(250) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `article` varchar(250) DEFAULT NULL,
  `sites` varchar(250) DEFAULT NULL,
  `etat` varchar(30) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `assigne` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


