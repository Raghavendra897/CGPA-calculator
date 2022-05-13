
DROP TABLE IF EXISTS `subjectdata`;
CREATE TABLE IF NOT EXISTS `subjectdata` (
  `name` varchar(100) NOT NULL,
  `credits` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
