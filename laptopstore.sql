-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 06:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptopstore`
--

DELIMITER $$
--
-- Procedures

-- CREATE DEFINER=`root`@`localhost` PROCEDURE `EXPIRY` ()  NO SQL
-- BEGIN
-- SELECT p_id,ven_id,lap_id,p_qty,p_cost,pur_date,mfg_date,exp_date FROM purchase where exp_date between CURDATE() and DATE_SUB(CURDATE(), INTERVAL -6 MONTH);
-- END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SEARCH_INVENTORY` (IN `search` VARCHAR(255))  NO SQL
BEGIN
DECLARE lid DECIMAL(6);
DECLARE lname VARCHAR(50);
DECLARE lqty INT;
DECLARE lcategory VARCHAR(20);
DECLARE lprice DECIMAL(6,2);
DECLARE exit_loop BOOLEAN DEFAULT FALSE;
DECLARE LAP_CURSOR CURSOR FOR SELECT LAP_ID,LAP_NAME,LAP_QTY,CATEGORY,LAP_PRICE FROM LAPTOP;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop=TRUE;
CREATE TEMPORARY TABLE IF NOT EXISTS T1 (lapid decimal(6),lapname varchar(50),lapqty int,lapcategory varchar(20),lapprice decimal(6,2));
OPEN LAP_CURSOR;
lap_loop: LOOP
FETCH FROM LAP_CURSOR INTO lid,lname,lqty,lcategory,lprice;
IF exit_loop THEN
LEAVE lap_loop;
END IF;

IF(CONCAT(lid,lname,lcategory) LIKE CONCAT('%',search,'%')) THEN
INSERT INTO T1(lapid,lapname,lapqty,lapcategory,lapprice)
VALUES(lid,lname,lqty,lcategory,lprice);
END IF;
END LOOP lap_loop;
CLOSE LAP_CURSOR;
SELECT lapid,lapname,lapqty,lapcategory,lapprice FROM T1; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `STOCK` ()  NO SQL
BEGIN
SELECT lap_id,lap_name,lap_qty,category,lap_price FROM laptop where lap_qty<=5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TOTAL_AMT` (IN `ID` INT, OUT `AMT` DECIMAL(8,2))  NO SQL
BEGIN
UPDATE SALES SET S_DATE=SYSDATE(),S_TIME=CURRENT_TIMESTAMP(),TOTAL_AMT=(SELECT SUM(TOT_PRICE) FROM SALES_ITEMS WHERE SALES_ITEMS.SALE_ID=ID) WHERE SALES.SALE_ID=ID;
SELECT TOTAL_AMT INTO AMT FROM SALES WHERE SALE_ID=ID;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `P_AMT` (`start` DATE, `end` DATE) RETURNS DECIMAL(8,2) NO SQL
    DETERMINISTIC
BEGIN
DECLARE PAMT DECIMAL(8,2) DEFAULT 0.0;
SELECT SUM(P_COST) INTO PAMT FROM PURCHASE WHERE PUR_DATE >= start AND PUR_DATE<= end;
RETURN PAMT;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `S_AMT` (`start` DATE, `end` DATE) RETURNS DECIMAL(8,2) NO SQL
BEGIN
DECLARE SAMT DECIMAL(8,2) DEFAULT 0.0;
SELECT SUM(TOTAL_AMT) INTO SAMT FROM SALES WHERE S_DATE >= start AND S_DATE<= end;
RETURN SAMT;
END$$

DELIMITER ;

-- -------------------------------------------------------


--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` decimal(7,0) NOT NULL,
  `A_USERNAME` varchar(50) NOT NULL,
  `A_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `A_USERNAME`, `A_PASSWORD`) VALUES
('1', 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `C_ID` decimal(6,0) NOT NULL,
  `C_FNAME` varchar(30) NOT NULL,
  `C_LNAME` varchar(30) DEFAULT NULL,
  `C_AGE` int(11) NOT NULL,
  `C_SEX` varchar(6) NOT NULL,
  `C_PHNO` decimal(10,0) NOT NULL,
  `C_MAIL` varchar(40) DEFAULT NULL
) ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`C_ID`, `C_FNAME`, `C_LNAME`, `C_AGE`, `C_SEX`, `C_PHNO`, `C_MAIL`) VALUES
('987101', 'Saf', 'Mehta', 22, 'Female', '9632587415', 'safmehta@gmail.com'),
('987102', 'Varun', 'Kumar', 24, 'Male', '9987565423', 'varun@gmail.com'),
('987103', 'Suja', 'Suresh', 45, 'Female', '7896541236', 'suja@hotmail.com'),
('987104', 'Agatha', 'Lisa', 30, 'Female', '7845129635', 'lisa@gmail.com'),
('987105', 'Zayed', 'Malik', 40, 'Male', '6789541235', 'zayed@hotmail.com'),
('987106', 'Shawn', 'Mendez', 60, 'Male', '8996574123', 'mendez@yahoo.com'),
('987107', 'Meera', 'Das', 35, 'Female', '7845963259', 'meeradas@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `emplogin`
--

CREATE TABLE `emplogin` (
  `E_ID` decimal(7,0) NOT NULL,
  `E_USERNAME` varchar(20) NOT NULL,
  `E_PASS` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emplogin`
--

INSERT INTO `emplogin` (`E_ID`, `E_USERNAME`, `E_PASS`) VALUES
('4567005', 'akshay', 'pass1'),
('4567002', 'harsha', 'pass2'),
('4567010', 'hemanth', 'pass3'),
('4567003', 'karthik', 'pass4'),
('4567009', 'chinmay', 'pass5'),
('4567006', 'prathik', 'pass6'),
('4567001', 'ramesh', 'pass7');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `E_ID` decimal(7,0) NOT NULL,
  `E_FNAME` varchar(30) NOT NULL,
  `E_LNAME` varchar(30) DEFAULT NULL,
  `BDATE` date NOT NULL,
  `E_AGE` int(11) NOT NULL,
  `E_SEX` varchar(6) NOT NULL,
  `E_JDATE` date NOT NULL,
  `E_SAL` decimal(8,2) NOT NULL,
  `E_PHNO` decimal(10,0) NOT NULL,
  `E_MAIL` varchar(40) DEFAULT NULL,
  `E_ADD` varchar(40) DEFAULT NULL
) ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`E_ID`, `E_FNAME`, `E_LNAME`, `BDATE`, `E_AGE`, `E_SEX`, `E_JDATE`, `E_SAL`, `E_PHNO`, `E_MAIL`, `E_ADD`) VALUES
('1', 'Admin', '-', '1989-05-24', 30, 'Female', '2009-06-24', '95000.00', '9874563219', 'admin@pharmacia.com', 'Chennai'),
('4567001', 'Ramesh', 'Elangovan', '1995-10-05', 25, 'Female', '2017-11-12', '25000.00', '9967845123', 'ramesh@hotmail.com', 'Thiruvanmiyur'),
('4567002', 'Harsha', 'Divakar', '2000-10-03', 20, 'Female', '2012-10-06', '45000.00', '8546123566', 'harsha@gmail.com', 'Adyar'),
('4567003', 'Karthik', 'Raj', '1998-02-01', 22, 'Male', '2019-07-06', '21000.00', '7854123694', 'karthik@live.com', 'T.Nagar'),
('4567005', 'Akshay', 'Kaushik', '1992-01-02', 28, 'Female', '2017-05-16', '32000.00', '7894532165', 'avk@gmail.com', 'Kottivakkam'),
('4567006', 'Prathik', 'Raj', '1999-12-11', 20, 'Male', '2018-09-05', '28000.00', '7896541234', 'praj@hotmail.com', 'Porur'),
('4567009', 'Chinmay', 'Hegde', '1980-02-28', 40, 'Female', '2010-05-06', '80000.00', '7854123695', 'hegde@gmail.com', 'Adyar'),
('4567010', 'Hemanth', 'Kumar', '1993-04-05', 27, 'Male', '2016-01-05', '30000.00', '7896541235', 'hemanth@gmail.com', 'Kodambakkam');

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE `laptop` (
  `LAP_ID` decimal(6,0) NOT NULL,
  `LAP_NAME` varchar(50) NOT NULL,
  `LAP_QTY` int(11) NOT NULL,
  `CATEGORY` varchar(20) DEFAULT NULL,
  `LAP_PRICE` decimal(8,2) NOT NULL
);

CREATE TABLE `laptopspecs`(
  `LAP_ID` decimal(6,0) NOT NULL,
  `LAP_IMAGE` longblob,
  `CPU` varchar(20) NOT NULL,
  `GPU` varchar(20),
  `DISP_SIZE` varchar(10) NOT NULL,
  `DISP_RES` varchar(10) NOT NULL,
  `REFRESH_RATE` VARCHAR(10) NOT NULL,
  `RAM` varchar(10) NOT NULL,
  `STORAGE` varchar(20) NOT NULL,
  `BATTERY` varchar(20) NOT NULL
);
--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`LAP_ID`, `LAP_NAME`, `LAP_QTY`, `CATEGORY`, `LAP_PRICE` ) VALUES
('123001', 'Asus F-15', 15, 'Gaming', '58990'),
('123002', 'HP Pavillion 15', 20, 'Notebook', '72990'),
('123003', 'Asus ROG strix', 25, 'Gaming', '79990'),
('123004', 'HP Omen', 20, 'Gaming', '72000'),
('123005', 'Dell G15', 10, 'Gaming', '88990'),
('123006', 'Dell Alienware', 35, 'Gaming', '224999'),
('123007', 'HP Pavillion x360', 15, 'Convertible', '73990'),
('123008', 'Asus Vivobook', 20, 'Ultrabook', '42990'),
('123009', 'HP Victus 16', 15, 'Gaming', '76020'),
('123010', 'MacBook pro', 9, 'MacBook', '194900'),
('123011', 'Dell XPS 13', 15, 'Ultrabook', '83990');


-- --------------------------------------------------------


INSERT INTO `laptopspecs` VALUES('123001',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\f15.png'),'Intel i5-10300h', 'GTX 1650ti', '15.6"', 'FHD', '144HZ', '8 GB', '512 GB SSD', '48 WHrs' );
INSERT INTO `laptopspecs` VALUES('123002',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\pavilion15.png'),'Intel i5-1135G7', 'None', '15.6"', 'FHD', '60HZ', '8 GB', '512 GB SSD', '41 WHrs' );
INSERT INTO `laptopspecs` VALUES('123003',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\strix.png'),'Intel i5-10300h', 'GTX 1650ti', '15.6"', 'FHD', '144HZ', '8 GB', '1 TB SSD', '43 WHrs' );
INSERT INTO `laptopspecs` VALUES('123004',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\omen.png'),'Intel i5-10300h', 'GTX 1650', '15.6"', 'FHD', '144HZ', '8 GB', '512 GB SSD', '48 WHrs' );
INSERT INTO `laptopspecs` VALUES('123005',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\dell_g15.png'),'Intel i5-11400h', 'RTX 3050', '15.6"', 'FHD', '240HZ', '8 GB', '512 GB SSD + 1 TB HDD', '56 WHrs' );
INSERT INTO `laptopspecs` VALUES('123006',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\alienware.png'),'Intel i7-11800h', 'RTX 3070', '15.6"', 'FHD', '145HZ', '16 GB', '512 GB + 1 TB HDD', '86 WHrs' );
INSERT INTO `laptopspecs` VALUES('123007',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\x360.png'),'Intel i5-1135G7', 'None', '14"', 'FHD', '60HZ', '16 GB', '512 GB SSD', '43 WHrs' );
INSERT INTO `laptopspecs` VALUES('123008',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\vivobook.png'),'Intel i5-1135G7', 'None', '15.6"', 'FHD', '60HZ', '16 GB', '512 GB SSD', '43 WHrs' );
INSERT INTO `laptopspecs` VALUES('123009',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\victus.png'),'Ryzen 5 5600h', 'GTX 1650ti', '16.1"', 'FHD', '144HZ', '8 GB', '512 GB SSD', '48 WHrs' );
INSERT INTO `laptopspecs` VALUES('123010',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\macbook.png'),'Apple m1 pro chip', '14-core GPU integrated', '14"', 'FHD', '120 HZ', '16 GB unified memory', '512 GB SSD', '70 WHrs' );
INSERT INTO `laptopspecs` VALUES('123011',  load_file('C:\xampp\htdocs\laptop-store\laptop-dbms\xps13.png'),'Intel i5-1137G7', 'None', '13', 'FHD', '60HZ', '16 GB', '512 GB', '52 WHrs' );



-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `P_ID` decimal(4,0) NOT NULL,
  `VEN_ID` decimal(3,0) NOT NULL,
  `LAP_ID` decimal(6,0) NOT NULL,
  `P_QTY` int(11) NOT NULL,
  `P_COST` decimal(8,2) NOT NULL,
  `PUR_DATE` date NOT NULL,
  `MFG_DATE` date NOT NULL
) ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`P_ID`, `VEN_ID`, `LAP_ID`, `P_QTY`, `P_COST`, `PUR_DATE`, `MFG_DATE`) VALUES
('1001', '136', '123010', 2, '389800', '2020-03-01', '2019-05-05'),
('1002', '123', '123002', 8, '583920', '2020-03-05', '2018-06-01'),
('1003', '145', '123006', 2, '449998', '2020-04-22', '2017-02-05'),
('1004', '156', '123004', 3, '216000', '2020-05-02', '2020-05-06'),
('1005', '123', '123005', 10, '889900', '2020-06-01', '2019-08-02'),
('1006', '162', '123010', 3, '584700', '2019-07-22', '2018-01-01'),
('1007', '123', '123001', 8, '471920', '2020-08-02', '2019-01-05');

--
-- Triggers `purchase`
--

DELIMITER $$
CREATE TRIGGER `QTYINSERT` AFTER INSERT ON `purchase` FOR EACH ROW BEGIN
UPDATE laptop SET LAP_QTY=LAP_QTY+new.P_QTY WHERE laptop.LAP_ID=new.LAP_ID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `QTYUPDATE` AFTER UPDATE ON `purchase` FOR EACH ROW BEGIN
UPDATE laptop SET LAP_QTY=LAP_QTY-old.P_QTY WHERE laptop.LAP_ID=new.LAP_ID;
UPDATE laptop SET LAP_QTY=LAP_QTY+new.P_QTY WHERE laptop.LAP_ID=new.LAP_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SALE_ID` int(11) NOT NULL,
  `C_ID` decimal(6,0) NOT NULL,
  `S_DATE` date DEFAULT NULL,
  `S_TIME` time DEFAULT NULL,
  `TOTAL_AMT` decimal(12,2) DEFAULT NULL,
  `E_ID` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SALE_ID`, `C_ID`, `S_DATE`, `S_TIME`, `TOTAL_AMT`, `E_ID`) VALUES
(1, '987101', '2020-04-15', '13:23:03', '194900', '4567009'),
(2, '987106', '2020-04-21', '20:19:31', '85980', '1'),
(3, '987103', '2020-04-15', '11:23:53', '42990', '4567010'),
(4, '987104', '2020-04-14', '18:20:00', '224999', '4567006'),
(5, '987103', '2020-04-21', '15:24:43', '79990', '1'),
(6, '987102', '2020-03-11', '10:24:43', '449998', '4567001'),
(7, '987105', '2020-04-24', '00:25:54', '194900', '1'),
(8, '987104', '2020-04-24', '00:47:47', '83990', '4567001'),
(12, '987103', '2020-04-24', '19:33:16', '266970', '1'),
(13, '987104', '2020-04-24', '21:15:56', '76020', '4567001'),
(15, '987107', '2020-12-04', '18:39:46', '76020', '1'),
(16, '987106', '2020-12-04', '18:52:21', '72990', '1'),
(17, '987103', '2020-12-04', '19:35:56', '58990', '1'),
(18, '987105', '2020-12-04', '19:36:56', '224999', '4567001'),
(20, '987103', '2020-12-04', '22:53:18', '83990', '4567001');

--
-- Triggers `sales`
--
DELIMITER $$
CREATE TRIGGER `SALE_ID_DELETE` BEFORE DELETE ON `sales` FOR EACH ROW BEGIN
DELETE from sales_items WHERE sales_items.SALE_ID=old.SALE_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `SALE_ID` int(11) NOT NULL,
  `LAP_ID` decimal(6,0) NOT NULL,
  `SALE_QTY` int(11) NOT NULL,
  `TOT_PRICE` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`SALE_ID`, `LAP_ID`, `SALE_QTY`, `TOT_PRICE`) VALUES
(1, '123010', 1, '194900'),
(2, '123008', 2, '85980'),
(3, '123008', 1, '42990'),
(4, '123006', 1, '224999'),
(5, '123001', 1, '79990'),
(6, '123006', 2, '449998'),
(7, '123006', 1, '194900'),
(8, '123011', 1, '83990'),
(12, '123005', 3, '266970'),
(13, '123009', 1, '76020'),
(15, '123009', 1, '76020'),
(16, '123002', 1, '72990'),
(17, '123001', 1, '58990'),
(18, '123006', 1, '224999'),
(20, '123011', 1, '85980');

--
-- Triggers `sales_items`
--
DELIMITER $$
CREATE TRIGGER `SALEDELETE` AFTER DELETE ON `sales_items` FOR EACH ROW BEGIN
UPDATE laptop SET LAP_QTY=LAP_QTY+old.SALE_QTY WHERE laptop.LAP_ID=old.LAP_ID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `SALEINSERT` AFTER INSERT ON `sales_items` FOR EACH ROW BEGIN
UPDATE laptop SET LAP_QTY=LAP_QTY-new.SALE_QTY WHERE laptop.LAP_ID=new.LAP_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `VEN_ID` decimal(3,0) NOT NULL,
  `VEN_NAME` varchar(25) NOT NULL,
  `VEN_ADD` varchar(30) NOT NULL,
  `VEN_PHNO` decimal(10,0) NOT NULL,
  `VEN_MAIL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`VEN_ID`, `VEN_NAME`, `VEN_ADD`, `VEN_PHNO`, `VEN_MAIL`) VALUES
('123', 'XYZ Electronics', 'Chennai, Tamil Nadu', '8745632145', 'xyz@electro.com'),
('136', 'ABC E-store', 'Trichy', '7894561235', 'abc@estore.com'),
('145', 'Daily Laptops Ltd', 'Hyderabad', '7854699321', 'daily@elec.com'),
('156', 'E-All', 'Chennai', '9874585236', 'mainid@eall.com'),
('162', 'E-Head Electronics', 'Trichy', '7894561335', 'abc@electronics.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`A_USERNAME`),
  ADD UNIQUE KEY `USERNAME` (`A_USERNAME`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`C_ID`),
  ADD UNIQUE KEY `C_PHNO` (`C_PHNO`),
  ADD UNIQUE KEY `C_MAIL` (`C_MAIL`);

--
-- Indexes for table `emplogin`
--
ALTER TABLE `emplogin`
  ADD PRIMARY KEY (`E_USERNAME`),
  ADD KEY `E_ID` (`E_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`E_ID`);

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`LAP_ID`);

ALTER TABLE `laptopspecs`
  ADD PRIMARY KEY (`LAP_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`P_ID`,`LAP_ID`),
  ADD KEY `VEN_ID` (`VEN_ID`),
  ADD KEY `LAP_ID` (`LAP_ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SALE_ID`),
  ADD KEY `C_ID` (`C_ID`),
  ADD KEY `E_ID` (`E_ID`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`SALE_ID`,`LAP_ID`),
  ADD KEY `LAP_ID` (`LAP_ID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`VEN_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SALE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--
ALTER TABLE `laptopspecs`
  ADD CONSTRAINT `laptopspecs_fk` FOREIGN KEY (`LAP_ID`) REFERENCES `laptop` (`LAP_ID`) ON DELETE CASCADE;
--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`E_ID`) ON DELETE CASCADE;

--
-- Constraints for table `emplogin`
--
ALTER TABLE `emplogin`
  ADD CONSTRAINT `emplogin_ibfk_1` FOREIGN KEY (`E_ID`) REFERENCES `employee` (`E_ID`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`VEN_ID`) REFERENCES `vendor` (`VEN_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`LAP_ID`) REFERENCES `laptop` (`LAP_ID`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `customer` (`C_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`E_ID`) REFERENCES `employee` (`E_ID`) ON DELETE CASCADE;

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`SALE_ID`) REFERENCES `sales` (`SALE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`LAP_ID`) REFERENCES `laptop` (`LAP_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
