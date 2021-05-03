
DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `value` varchar(100) COMMENT 'Value',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Config';


LOCK TABLES `config` WRITE;

INSERT INTO `config` VALUES (1,'picture1','/ClubPlus/upload/111.png'),(2,'picture2','/ClubPlus/upload/222.png'),(3,'picture3','/ClubPlus/upload/333.png'),(6,'homepage',NULL);

UNLOCK TABLES;


DROP TABLE IF EXISTS `EventApplication`;

CREATE TABLE `EventApplication` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'EventApplicationID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `eventname` varchar(200) DEFAULT NULL COMMENT 'Event',
  `eventstype` varchar(200) DEFAULT NULL COMMENT 'Type',
  `image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `eventaddress` varchar(200) DEFAULT NULL COMMENT 'Address',
  `eventstime` varchar(200) DEFAULT NULL COMMENT 'Time',
  `participants` int(11) DEFAULT NULL COMMENT 'Participants',
  `clubaccount` varchar(200) DEFAULT NULL COMMENT 'ClubAccount',
  `clubname` varchar(200) DEFAULT NULL COMMENT 'Club',
  `contacts` varchar(200) DEFAULT NULL COMMENT 'Contacts',
  `phone` varchar(200) DEFAULT NULL COMMENT 'Phone',
  `ordinaryusername` varchar(200) DEFAULT NULL COMMENT 'UserName',
  `name` varchar(200) DEFAULT NULL COMMENT 'Name',
  `sfsh` varchar(200) DEFAULT ' ' COMMENT 'Approvel',
  `shhf` longtext COMMENT 'Comment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='EventApplication';


LOCK TABLES `EventApplication` WRITE;

INSERT INTO `EventApplication` VALUES (61,'2021-02-19 23:04:29','Event1','Type',NULL,'Address1','Time1',1,'ClubAccount1','Club1','Contacts1','Phone1','User1','Name1','Approved','');

UNLOCK TABLES;



DROP TABLE IF EXISTS `Club`;

CREATE TABLE `Club` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ClubID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `clubaccount` varchar(200) NOT NULL COMMENT 'ClubAccount',
  `password` varchar(200) NOT NULL COMMENT 'Password',
  `image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `clubname` varchar(200) NOT NULL COMMENT 'Club',
  `clubtype` varchar(200) DEFAULT NULL COMMENT 'Type',
  `contacts` varchar(200) DEFAULT NULL COMMENT 'Contacts',
  `phone` varchar(200) DEFAULT NULL COMMENT 'Phone',
  PRIMARY KEY (`id`),
  UNIQUE KEY `clubaccount` (`clubaccount`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='Club';


LOCK TABLES `Club` WRITE;

INSERT INTO `Club` VALUES (11,'2021-02-19 23:04:29','ClubAccount1','123456',NULL,'Club1','Type1','Contacts1','12023645187');

UNLOCK TABLES;



DROP TABLE IF EXISTS `Event`;

CREATE TABLE `Event` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'EventID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `eventname` varchar(200) NOT NULL COMMENT 'Event',
  `eventstype` varchar(200) NOT NULL COMMENT 'Type',
  `image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `eventaddress` varchar(200) DEFAULT NULL COMMENT 'Address',
  `eventstime` datetime DEFAULT NULL COMMENT 'Time',
  `participants` int(11) DEFAULT NULL COMMENT 'Participants',
  `eventcontent` longtext COMMENT 'Content',
  `clubaccount` varchar(200) DEFAULT NULL COMMENT 'ClubAccount',
  `clubname` varchar(200) DEFAULT NULL COMMENT 'Club',
  `contacts` varchar(200) DEFAULT NULL COMMENT 'Contacts',
  `phone` varchar(200) DEFAULT NULL COMMENT 'Phone',
  `clicktime` datetime DEFAULT NULL COMMENT 'ClickTime',
  `clicknum` int(11) DEFAULT '0' COMMENT 'ClickNum',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='Event';


LOCK TABLES `Event` WRITE;

INSERT INTO `Event` VALUES (31,'2021-02-19 23:04:29','Event1','Type1',NULL,'Address1','2021-04-20 07:04:29',1,'Content1','ClubAccount1','Club1','Contacts1','Phone1','2021-04-20 07:04:29',1);

UNLOCK TABLES;



DROP TABLE IF EXISTS `Album`;

CREATE TABLE `Album` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'AlbumID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `albumtitle` varchar(200) DEFAULT NULL COMMENT 'AlbumTitle',
  `clubaccount` varchar(200) DEFAULT NULL COMMENT 'ClubAccount',
  `clubname` varchar(200) DEFAULT NULL COMMENT 'Club',
  `clubtype` varchar(200) DEFAULT NULL COMMENT 'ClubType',
  `coverphoto` varchar(200) DEFAULT NULL COMMENT 'CoverPhoto',
  `albumcontent` longtext COMMENT 'Content',
  `albumaddtime` date DEFAULT NULL COMMENT 'Time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='Album';


LOCK TABLES `Album` WRITE;

INSERT INTO `Album` VALUES (41,'2021-02-19 23:04:29','AlbumTitle1','ClubAccount1','Club1','ClubType1',Null,'AlubmContent1','2021-04-20');

UNLOCK TABLES;



DROP TABLE IF EXISTS `ClubInfo`;

CREATE TABLE `ClubInfo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ClubInfoID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `clubaccount` varchar(200) DEFAULT NULL COMMENT 'ClubAccount',
  `clubname` varchar(200) DEFAULT NULL COMMENT 'Club',
  `clubtype` varchar(200) DEFAULT NULL COMMENT 'Type',
  `image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `contacts` varchar(200) DEFAULT NULL COMMENT 'Contacts',
  `phone` varchar(200) DEFAULT NULL COMMENT 'Phone',
  `clubaddress` varchar(200) DEFAULT NULL COMMENT 'Address',
  `clubintro` longtext COMMENT 'Introduction',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='ClubInfo';


LOCK TABLES `ClubInfo` WRITE;

INSERT INTO `ClubInfo` VALUES (21,'2021-02-19 23:04:29','ClubAccount1','Club1','Type1',Null,'Contacts1','Phone1','Address1','Introduction1');

UNLOCK TABLES;



DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'AnnouncementID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `title` varchar(200) NOT NULL COMMENT 'Title',
  `introduction` longtext COMMENT 'Intro',
  `picture` varchar(200) NOT NULL COMMENT 'Image',
  `content` longtext NOT NULL COMMENT 'Content',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COMMENT='Announcement';


LOCK TABLES `news` WRITE;

INSERT INTO `news` VALUES (91,'2021-02-19 23:04:29','Title1','Intro1','/ClubPlus/upload/picture1.jpg','Content1');

UNLOCK TABLES;



DROP TABLE IF EXISTS `ClubApplication`;

CREATE TABLE `ClubApplication` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ClubApplicationID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `clubaccount` varchar(200) DEFAULT NULL COMMENT 'ClubAccount',
  `clubname` varchar(200) DEFAULT NULL COMMENT 'Club',
  `clubtype` varchar(200) DEFAULT NULL COMMENT 'Type',
  `phone` varchar(200) DEFAULT NULL COMMENT 'Phone',
  `clubaddress` varchar(200) DEFAULT NULL COMMENT 'Address',
  `ordinaryusername` varchar(200) DEFAULT NULL COMMENT 'UserName',
  `name` varchar(200) DEFAULT NULL COMMENT 'Name',
  `sfsh` varchar(200) DEFAULT ' ' COMMENT 'Approval',
  `shhf` longtext COMMENT 'Comment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COMMENT='ClubApplication';


LOCK TABLES `ClubApplication` WRITE;

INSERT INTO `ClubApplication` VALUES (71,'2021-04-19 23:04:29','ClubAccount1','Club1','Type1','Phone1','Address1','UserName1','Name1','Approved','');

UNLOCK TABLES;



DROP TABLE IF EXISTS `storeup`;

CREATE TABLE `storeup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'StoreupID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `userid` bigint(20) NOT NULL COMMENT 'UserID',
  `refid` bigint(20) DEFAULT NULL COMMENT 'FavoriteID',
  `tablename` varchar(200) DEFAULT NULL COMMENT 'TableName',
  `name` varchar(200) NOT NULL COMMENT 'name',
  `picture` varchar(200) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Storeup';


LOCK TABLES `storeup` WRITE;

UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'AdminID',
  `username` varchar(100) NOT NULL COMMENT 'AdminUserName',
  `password` varchar(100) NOT NULL COMMENT 'Password',
  `role` varchar(100) DEFAULT 'Admin' COMMENT 'Role',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addtime',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Admin';


LOCK TABLES `users` WRITE;

INSERT INTO `users` VALUES (1,'admin','admin','admin','2021-03-19 23:04:29');

UNLOCK TABLES;



DROP TABLE IF EXISTS `OrdinaryUser`;

CREATE TABLE `OrdinaryUser` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'UserID',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addTime',
  `ordinaryusername` varchar(200) NOT NULL COMMENT 'UserName',
  `password` varchar(200) NOT NULL COMMENT 'Password',
  `name` varchar(200) NOT NULL COMMENT 'Name',
  `gender` varchar(200) DEFAULT NULL COMMENT 'Gender',
  `profilephoto` varchar(200) DEFAULT NULL COMMENT 'ProfilePhoto',
  `email` varchar(200) DEFAULT NULL COMMENT 'Email',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ordinaryusername` (`ordinaryusername`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='OrdinaryUser';


LOCK TABLES `OrdinaryUser` WRITE;

INSERT INTO `OrdinaryUser` VALUES (51,'2021-03-19 23:04:29','User1','123456','Name1','Male',Null,'773890001@gamil.com');

UNLOCK TABLES;

