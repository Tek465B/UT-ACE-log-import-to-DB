CREATE TABLE IF NOT EXISTS `Contacts` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `mhash1` varchar(75) NOT NULL,
  `mhash2` varchar(75) NOT NULL,
  `hash` varchar(75) NOT NULL,
  `ipaddr` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1234 ;
