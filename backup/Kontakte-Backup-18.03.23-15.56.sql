
/*!40000 DROP DATABASE IF EXISTS `ot`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ot` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ot`;
DROP TABLE IF EXISTS `daten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vname` varchar(30) DEFAULT NULL,
  `nname` varchar(30) DEFAULT NULL,
  `nummer` varchar(15) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `loginid` varchar(30) DEFAULT NULL,
  `access_lvl` int(11) DEFAULT NULL,
  `2fa_key` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `daten` VALUES (1,'admin','admin','1337','$2y$10$WA4qGQaMwUf0md7JN91PxevubFB0Kq/4KQ15SWH6w20j2xiECRKxa','admin',10,NULL);
