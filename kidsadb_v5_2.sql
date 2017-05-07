-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 04:11 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidsacsut_kidsadb`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addChild`$$
CREATE DEFINER =`kidsacsut_kidsacsut`@`localhost` PROCEDURE `addChild`(IN `p_Username` VARCHAR(100),
                                                                       IN `p_Name`     VARCHAR(100),
                                                                       IN `p_Birthday` DATE) BEGIN
  INSERT INTO children (Parent, Name, Birthday)
  VALUES (p_Username, p_Name, p_Birthday);
END$$

DROP PROCEDURE IF EXISTS `addUserLike`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `addUserLike`(IN `p_UserID` INT(11), IN `p_PostID` INT(11)) BEGIN
  INSERT INTO likedposts (User, Post)
  VALUES (p_UserID, p_PostID);
END$$

DROP PROCEDURE IF EXISTS `changePassword`$$
CREATE DEFINER =`kidsacsut_kidsacsut`@`localhost` PROCEDURE `changePassword`(IN `p_Id`       INT,
                                                                             IN `p_Password` VARCHAR(255)) BEGIN
  UPDATE users
  SET Password = p_Password
  WHERE users.ID = p_Id;
END$$

DROP PROCEDURE IF EXISTS `createNewFBuser`$$
CREATE DEFINER =`kidsacsut_kidsacsut`@`localhost` PROCEDURE `createNewFBuser`(IN `p_Name`     VARCHAR(100),
                                                                              IN `p_Username` VARCHAR(100),
                                                                              IN `p_Email`    VARCHAR(100)) BEGIN
  INSERT INTO users (Name, Username, Email)
  VALUES (p_Name, p_Username, p_Email);
END$$

DROP PROCEDURE IF EXISTS `createNewUser`$$
CREATE DEFINER =`kidsacsut_kidsacsut`@`localhost` PROCEDURE `createNewUser`(IN `p_Username` VARCHAR(100),
                                                                            IN `p_Password` VARCHAR(255),
                                                                            IN `p_Email`    VARCHAR(100)) BEGIN
  INSERT INTO users (Username, Password, Email)
  VALUES (p_Username, p_Password, p_Email);
END$$

DROP PROCEDURE IF EXISTS `getPosts`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `getPosts`() BEGIN
  SELECT *
  FROM postview
  WHERE postview.Public = 'y'
  ORDER BY postview.Date DESC;
END$$

DROP PROCEDURE IF EXISTS `getUserChildren`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `getUserChildren`(IN `p_Id` INT(11)) BEGIN
  SELECT *
  FROM childview
  WHERE Parent = p_Id
  ORDER BY Id DESC;
END$$

DROP PROCEDURE IF EXISTS `getUserChildrenPostsNo`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `getUserChildrenPostsNo`(IN `p_Id` INT(11)) BEGIN
  SELECT
    v_childrenpostscount.Child,
    v_childrenpostscount.Posts AS Posts
  FROM v_childrenpostscount
  WHERE User = p_Id
  ORDER BY Posts DESC;
END$$

DROP PROCEDURE IF EXISTS `getUserPosts`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `getUserPosts`(IN `p_Id` INT(11)) BEGIN
  SELECT *
  FROM postview
  WHERE User = p_Id
  ORDER BY postview.Date DESC;
END$$

DROP PROCEDURE IF EXISTS `newPost`$$
CREATE DEFINER =`kidsacsut_kidsacsut`@`localhost` PROCEDURE `newPost`(IN `p_User` INT(11), IN `p_Public` CHAR(1),
                                                                      IN `p_Text` VARCHAR(1000)) BEGIN
  INSERT INTO posts (User, Public, Text)
  VALUES (p_User, p_Public, p_Text);
END$$

DROP PROCEDURE IF EXISTS `newPostwLink`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `newPostwLink`(IN `p_User`  INT(11), IN `p_Public` CHAR(1),
                                                                 IN `p_Text`  VARCHAR(1000), IN `p_Language` VARCHAR(2),
                                                                 IN `p_Child` INT(11)) BEGIN
  START TRANSACTION;
  INSERT INTO posts (User, Public, Text, Language)
  VALUES (p_User, p_Public, p_Text, p_Language);
  INSERT INTO childrenposts (Child, Post)
  VALUES (p_child, LAST_INSERT_ID());
  COMMIT;
END$$

DROP PROCEDURE IF EXISTS `newPostwLinkTime`$$
CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `newPostwLinkTime`(IN `p_User`     INT(11), IN `p_Public` CHAR(1),
                                                                     IN `p_Text`     VARCHAR(1000),
                                                                     IN `p_Language` VARCHAR(2), IN `p_Child` INT(11),
                                                                     IN `p_Date`     INT(11)) BEGIN
  START TRANSACTION;
  INSERT INTO posts (User, Public, Text, Language, Date)
  VALUES (p_User, p_Public, p_Text, p_Language, FROM_UNIXTIME(p_Date));
  INSERT INTO childrenposts (Child, Post)
  VALUES (p_child, LAST_INSERT_ID());
  COMMIT;
END$$

DROP PROCEDURE IF EXISTS `deleteChild`$$


CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `deleteChild` (IN `c_ID` INT(11))  BEGIN
  DELETE FROM children
  WHERE id = c_ID;
END$$

DROP PROCEDURE IF EXISTS `getChild`$$


CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `getChild` (IN `c_ID` INT(11))  BEGIN
  SELECT *
  FROM childview
  WHERE id = c_ID;
END$$

DROP PROCEDURE IF EXISTS `editChild`$$


CREATE DEFINER =`kidsacsut`@`localhost` PROCEDURE `editChild` (IN `c_ID` INT(11),
							       IN `c_name` VARCHAR(100),
							       IN `c_birthday` DATE)  BEGIN
  UPDATE children
  SET Name=c_name, Birthday=c_birthday
  WHERE id = c_ID;
END$$
--
-- Functions
--
DROP FUNCTION IF EXISTS `f_calcAge`$$
CREATE DEFINER =`kidsacsut`@`localhost` FUNCTION `f_calcAge`(`Bday` DATE, `PostDate` TIMESTAMP)
  RETURNS INT(11) BEGIN
  DECLARE Age INT;
  SET Age = YEAR(FROM_DAYS(TO_DAYS(PostDate) - TO_DAYS(Bday)));
  RETURN Age;
END$$

DROP FUNCTION IF EXISTS `f_calcLikes`$$
CREATE DEFINER =`kidsacsut`@`localhost` FUNCTION `f_calcLikes`(`p_id` INT)
  RETURNS INT(11) READS SQL DATA
  BEGIN
    DECLARE result INT;
    SELECT count(DISTINCT user)
    INTO result
    FROM `likedposts`
    WHERE post = p_id;
    RETURN result;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
CREATE TABLE `children` (
  `ID`       INT(11)      NOT NULL,
  `Parent`   INT(11)      NOT NULL,
  `Name`     VARCHAR(100) NOT NULL,
  `Birthday` DATE         NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `childrenposts`
--

DROP TABLE IF EXISTS `childrenposts`;
CREATE TABLE `childrenposts` (
  `Child` INT(11) NOT NULL,
  `Post`  INT(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `childview`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `childview`;
CREATE TABLE `childview` (
  `ID`       INT(11)
  ,
  `Parent`   INT(11)
  ,
  `Name`     VARCHAR(100)
  ,
  `Birthday` DATE
);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `ID`    INT(11)      NOT NULL,
  `User`  INT(11)      NOT NULL,
  `Email` VARCHAR(100) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likedposts`
--

DROP TABLE IF EXISTS `likedposts`;
CREATE TABLE `likedposts` (
  `id`   INT(11) NOT NULL,
  `User` INT(11) NOT NULL,
  `Post` INT(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `ID`       INT(11)       NOT NULL,
  `User`     INT(11)       NOT NULL,
  `Public`   CHAR(1)       NOT NULL DEFAULT 'y',
  `Text`     VARCHAR(1000) NOT NULL,
  `Language` VARCHAR(2)    NOT NULL,
  `Date`     TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `postview`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `postview`;
CREATE TABLE `postview` (
  `ID`       INT(11)
  ,
  `User`     INT(11)
  ,
  `Public`   CHAR(1)
  ,
  `Text`     VARCHAR(1000)
  ,
  `Language` VARCHAR(2)
  ,
  `Date`     TIMESTAMP
  ,
  `Likes`    INT(11)
  ,
  `Name`     VARCHAR(100)
  ,
  `Birthday` DATE
  ,
  `Age`      INT(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID`       INT(11)      NOT NULL,
  `Name`     VARCHAR(100)          DEFAULT NULL,
  `Username` VARCHAR(100) NOT NULL,
  `Password` VARCHAR(255)          DEFAULT NULL,
  `Email`    VARCHAR(100) NOT NULL,
  `Regdate`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Image`    VARBINARY(200)        DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_childrenpostscount`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_childrenpostscount`;
CREATE TABLE `v_childrenpostscount` (
  `Child` VARCHAR(100)
  ,
  `User`  INT(11)
  ,
  `Posts` BIGINT(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_users`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_users`;
CREATE TABLE `v_users` (
  `id`       INT(11)
  ,
  `name`     VARCHAR(100)
  ,
  `username` VARCHAR(100)
  ,
  `password` VARCHAR(255)
);

-- --------------------------------------------------------

--
-- Structure for view `childview`
--
DROP TABLE IF EXISTS `childview`;

CREATE ALGORITHM = UNDEFINED
  DEFINER =`kidsacsut`@`localhost`
  SQL SECURITY DEFINER VIEW `childview` AS
  SELECT
    `children`.`ID`       AS `ID`,
    `children`.`Parent`   AS `Parent`,
    `children`.`Name`     AS `Name`,
    `children`.`Birthday` AS `Birthday`
  FROM `children`;

-- --------------------------------------------------------

--
-- Structure for view `postview`
--
DROP TABLE IF EXISTS `postview`;

CREATE ALGORITHM = UNDEFINED
  DEFINER =`kidsacsut`@`localhost`
  SQL SECURITY DEFINER VIEW `postview` AS
  SELECT
    `posts`.`ID`                                       AS `ID`,
    `posts`.`User`                                     AS `User`,
    `posts`.`Public`                                   AS `Public`,
    `posts`.`Text`                                     AS `Text`,
    `posts`.`Language`                                 AS `Language`,
    `posts`.`Date`                                     AS `Date`,
    `f_calcLikes`(`posts`.`ID`)                        AS `Likes`,
    `children`.`Name`                                  AS `Name`,
    `children`.`Birthday`                              AS `Birthday`,
    `f_calcAge`(`children`.`Birthday`, `posts`.`Date`) AS `Age`
  FROM ((`posts`
    LEFT JOIN `childrenposts` ON ((`posts`.`ID` = `childrenposts`.`Post`))) LEFT JOIN `children`
      ON ((`childrenposts`.`Child` = `children`.`ID`)));

-- --------------------------------------------------------

--
-- Structure for view `v_childrenpostscount`
--
DROP TABLE IF EXISTS `v_childrenpostscount`;

CREATE ALGORITHM = UNDEFINED
  DEFINER =`kidsacsut`@`localhost`
  SQL SECURITY DEFINER VIEW `v_childrenpostscount` AS
  SELECT
    `children`.`Name`   AS `Child`,
    `children`.`Parent` AS `User`,
    count(0)            AS `Posts`
  FROM (`children`
    JOIN `childrenposts` ON ((`children`.`ID` = `childrenposts`.`Child`)))
  GROUP BY `children`.`ID`;

-- --------------------------------------------------------

--
-- Structure for view `v_users`
--
DROP TABLE IF EXISTS `v_users`;

CREATE ALGORITHM = UNDEFINED
  DEFINER =`kidsacsut`@`localhost`
  SQL SECURITY DEFINER VIEW `v_users` AS
  SELECT
    `users`.`ID`       AS `id`,
    `users`.`Name`     AS `name`,
    `users`.`Username` AS `username`,
    `users`.`Password` AS `password`
  FROM `users`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Children2Users` (`Parent`);

--
-- Indexes for table `childrenposts`
--
ALTER TABLE `childrenposts`
  ADD KEY `fk_ChildrenPosts2Children` (`Child`),
  ADD KEY `fk_ChildrenPosts2Posts` (`Post`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Friends2Users` (`User`);

--
-- Indexes for table `likedposts`
--
ALTER TABLE `likedposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_LikedPosts2Users` (`User`),
  ADD KEY `fk_LikedPosts2Posts` (`Post`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Posts2Users` (`User`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likedposts`
--
ALTER TABLE `likedposts`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 58;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 364;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `fk_Children2Users` FOREIGN KEY (`Parent`) REFERENCES `users` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE;

--
-- Constraints for table `childrenposts`
--
ALTER TABLE `childrenposts`
  ADD CONSTRAINT `fk_ChildrenPosts2Children` FOREIGN KEY (`Child`) REFERENCES `children` (`ID`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ChildrenPosts2Posts` FOREIGN KEY (`Post`) REFERENCES `posts` (`ID`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `fk_Friends2Users` FOREIGN KEY (`User`) REFERENCES `users` (`ID`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Constraints for table `likedposts`
--
ALTER TABLE `likedposts`
  ADD CONSTRAINT `fk_LikedPosts2Posts` FOREIGN KEY (`Post`) REFERENCES `posts` (`ID`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_LikedPosts2Users` FOREIGN KEY (`User`) REFERENCES `users` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_Posts2Users` FOREIGN KEY (`User`) REFERENCES `users` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
