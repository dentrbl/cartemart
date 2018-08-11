-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for inventory
CREATE DATABASE IF NOT EXISTS `inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventory`;

-- Dumping structure for table inventory.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `catid` int(3) unsigned zerofill DEFAULT NULL,
  `categoryname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.categories: ~13 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`catid`, `categoryname`) VALUES
	(001, 'Beverage'),
	(002, 'Bread'),
	(003, 'Canned/Jarred Goods'),
	(004, 'Dairy'),
	(005, 'Baking Goods'),
	(006, 'Frozen Foods'),
	(007, 'Meat'),
	(009, 'Cleaners'),
	(010, 'Paper Goods'),
	(011, 'Personal Care'),
	(012, 'Others'),
	(008, 'Produce');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table inventory.manufacturers
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manuid` int(5) unsigned zerofill DEFAULT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `manudesc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.manufacturers: ~0 rows (approximately)
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;

-- Dumping structure for table inventory.plist
CREATE TABLE IF NOT EXISTS `plist` (
  `plist` int(5) unsigned zerofill NOT NULL,
  `productid` int(5) unsigned zerofill DEFAULT NULL,
  `promoid` int(5) unsigned zerofill DEFAULT NULL,
  `saleid` int(5) unsigned zerofill DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.plist: ~0 rows (approximately)
/*!40000 ALTER TABLE `plist` DISABLE KEYS */;
/*!40000 ALTER TABLE `plist` ENABLE KEYS */;

-- Dumping structure for table inventory.prodpromos
CREATE TABLE IF NOT EXISTS `prodpromos` (
  `promoid` int(5) unsigned zerofill DEFAULT NULL,
  `productid` int(5) unsigned zerofill DEFAULT NULL,
  `promoprice` float DEFAULT NULL,
  `promostatus` int(1) DEFAULT NULL COMMENT 'active/inactive',
  `dateadded` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateupdated` datetime DEFAULT CURRENT_TIMESTAMP,
  `datedeleted` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.prodpromos: ~0 rows (approximately)
/*!40000 ALTER TABLE `prodpromos` DISABLE KEYS */;
/*!40000 ALTER TABLE `prodpromos` ENABLE KEYS */;

-- Dumping structure for table inventory.prodsales
CREATE TABLE IF NOT EXISTS `prodsales` (
  `saleid` int(5) unsigned zerofill DEFAULT NULL,
  `productid` int(5) unsigned zerofill DEFAULT NULL,
  `saleprice` float DEFAULT NULL,
  `salestatus` int(1) DEFAULT NULL COMMENT 'active/inactive',
  `dateadded` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateupdated` datetime DEFAULT CURRENT_TIMESTAMP,
  `datedeleted` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.prodsales: ~0 rows (approximately)
/*!40000 ALTER TABLE `prodsales` DISABLE KEYS */;
/*!40000 ALTER TABLE `prodsales` ENABLE KEYS */;

-- Dumping structure for table inventory.products
CREATE TABLE IF NOT EXISTS `products` (
  `categoryid` int(3) unsigned zerofill DEFAULT NULL,
  `subcatid` int(3) unsigned zerofill DEFAULT NULL,
  `productid` int(5) unsigned zerofill DEFAULT NULL,
  `prodname` varchar(50) DEFAULT NULL,
  `proddesc` text,
  `prodprice` float DEFAULT NULL,
  `stock` int(6) unsigned zerofill DEFAULT NULL,
  `manuid` int(5) unsigned zerofill DEFAULT NULL COMMENT 'manufacturer id',
  `dateadded` datetime DEFAULT NULL,
  `datedeleted` datetime DEFAULT NULL COMMENT 'date when it became inactive',
  `dateupdated` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT 'active/inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.products: ~0 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table inventory.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `categoryid` int(3) unsigned zerofill DEFAULT NULL,
  `subcatid` int(3) DEFAULT NULL,
  `subcatname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.subcategories: ~44 rows (approximately)
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` (`categoryid`, `subcatid`, `subcatname`) VALUES
	(001, 101, 'Coffee'),
	(001, 102, 'Tea'),
	(001, 103, 'Juice'),
	(001, 104, 'Soda'),
	(002, 105, 'Loaves'),
	(002, 106, 'Dinner Rolls'),
	(002, 107, 'Bagels'),
	(003, 108, 'Sardines'),
	(003, 109, 'Spaghetti Sauce'),
	(003, 110, 'Processed Meat'),
	(003, 111, 'Condiments'),
	(003, 112, 'Bread Spreads'),
	(004, 113, 'Cheeses'),
	(004, 114, 'Eggs'),
	(004, 115, 'Milk'),
	(004, 116, 'Yogurt'),
	(004, 117, 'Butter'),
	(005, 118, 'Cereals'),
	(005, 119, 'Flour'),
	(005, 120, 'Sugar'),
	(005, 121, 'Pasta'),
	(005, 122, 'Mixes'),
	(006, 123, 'Waffles'),
	(006, 124, 'Vegetables'),
	(006, 125, 'Ready-to-Go Meals'),
	(006, 126, 'Ice Cream'),
	(007, 127, 'Lunch Meat'),
	(007, 128, 'Poultry'),
	(007, 129, 'Beef'),
	(007, 130, 'Pork'),
	(008, 131, 'Fruits'),
	(008, 132, 'Vegetables'),
	(009, 133, 'All Purpose Cleaners'),
	(009, 134, 'Laundry Detergent'),
	(009, 135, 'Dishwashing Liquid'),
	(010, 136, 'Paper Towels'),
	(010, 137, 'Toilet Paper'),
	(010, 138, 'ALuminum Foil'),
	(010, 139, 'Sandwich Bags'),
	(011, 140, 'Shampoo'),
	(011, 141, 'Soap'),
	(011, 142, 'Hand Soap'),
	(011, 143, 'Shaving Cream'),
	(011, 144, 'Tooth Paste'),
	(011, 145, 'Alcohol'),
	(011, 146, 'Earbuds'),
	(011, 147, 'Cotton'),
	(012, 148, 'Baby Items'),
	(012, 149, 'Pet Items'),
	(013, 150, 'Emergency Items');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;

-- Dumping structure for table inventory.userinfo
CREATE TABLE IF NOT EXISTS `userinfo` (
  `userid` int(5) unsigned zerofill DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` text,
  `address` text,
  `contactno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.userinfo: ~2 rows (approximately)
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` (`userid`, `name`, `email`, `address`, `contactno`) VALUES
	(00001, 'admin', 'admin', 'admin', '09123456789'),
	(00002, 'manager', 'manager@gmail.com', 'address', '09123456789'),
	(00003, 'Judy Ann Santos', 'judyannsantos@gmail.com', 'b4 L17 judy ann\'s kitchen, judy ann\'s house, judy ann\'s subdivision, judy ann\'s city', '09123456789');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;

-- Dumping structure for table inventory.userlist
CREATE TABLE IF NOT EXISTS `userlist` (
  `userid` int(5) unsigned zerofill NOT NULL,
  `plist` int(5) unsigned zerofill DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `totalprice` float unsigned DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.userlist: ~0 rows (approximately)
/*!40000 ALTER TABLE `userlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `userlist` ENABLE KEYS */;

-- Dumping structure for table inventory.users
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(5) unsigned zerofill NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `access` int(1) DEFAULT NULL COMMENT '0 - super admin 1 - manager admin 2 - customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userid`, `uname`, `pword`, `access`) VALUES
	(00001, 'admin', 'admin', 0),
	(00002, 'manager', 'manager', 1),
	(00003, 'judyskitchen', 'judyskitchen', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
