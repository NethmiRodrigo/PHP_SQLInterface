CREATE DATABASE `bankofasia`;
USE `bankofasia`;

CREATE TABLE `assignment` (
  `project_id` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_of_staff` int(11) DEFAULT NULL,
  `task_breakdown` varchar(255) DEFAULT NULL,
  `funding_period` varchar(50) DEFAULT NULL,
  `internal_flag` int(1) NOT NULL,
  `government_flag` int(1) NOT NULL,
  `thirdparty_flag` int(1) NOT NULL,
  `dept_code` int(11) NOT NULL
);

INSERT INTO `assignment` (`project_id`, `budget`, `duration`, `name`, `no_of_staff`, `task_breakdown`, `funding_period`, `internal_flag`, `government_flag`, `thirdparty_flag`, `dept_code`) VALUES
(2, 150000, '6 months', 'Project A', 10, NULL, NULL, 1, 0, 0, 15),
(5, 100000, '8 months', 'Project B', NULL, NULL, '6 months', 0, 0, 1, 15),
(10, 100000, '8 months', 'Project C', 5, 'QA', '', 1, 1, 0, 15),
(11, 100000, '8 months', 'Project D', 5, 'QA', '6 months', 1, 1, 1, 15),
(15, 100000, '8 months', 'Project E', 0, 'QA', '', 0, 1, 0, 16),
(16, 100000, '6 months', 'Project F', 0, '', '6 months', 0, 0, 1, 17),
(17, 150000, '14 months', 'Project G', 0, 'Analysis, Design', '12 months', 0, 1, 1, 18),
(18, 50000, '4 months', 'Project H', 0, '', '4 months', 0, 0, 1, 16),
(19, 15000, '8 months', 'Project I', 45, '', '', 1, 0, 0, 17),
(20, 50000, '14 months', 'Project J', 0, '', '12 months', 0, 0, 1, 18),
(21, 20000, '6 months', 'Project K', 4, '', '', 1, 0, 0, 20);

CREATE TABLE `assignments_per_department` (`dept_code` int(11),`dept_name` varchar(255),`TYPE` varchar(100),`head` int(11),`number_of_assignments` bigint(21),`total_budget` decimal(32,0));

CREATE TABLE `business` (
  `br_no` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `net_worth` decimal(10,0) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL
);

INSERT INTO `business` (`br_no`, `type`, `net_worth`, `customer_id`, `business_name`) VALUES
(1235, 'Catering', '150000', 8, 'Lakmi Foods'),
(45623, 'Security', '20000', 9, 'Secure Pro Ltd.'),
(56892, 'Logistics', '1000', 7, 'Logistics Ltd.'),
(78956, 'Paper Company', '500000', 12, 'Dunder Mifflin');

CREATE TABLE `company` (`company_id` int(11) NOT NULL,`head` varchar(255) NOT NULL);

INSERT INTO `company` (`company_id`, `head`) VALUES
(1, 'Mr. Daniel Doyle'),
(2, 'Mr. Hosier');

CREATE TABLE `company_assignment` (`company_id` int(11) NOT NULL,`project_id` int(11) NOT NULL);

INSERT INTO `company_assignment` (`company_id`, `project_id`) VALUES(1, 17),(1, 18),(1, 20),(2, 5),(2, 11),(2, 16);

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `branch_type` enum('Regional','Supergrade') DEFAULT NULL,
  `regional_branch_id` char(5) DEFAULT NULL,
  `supergrade_branch_id` char(5) DEFAULT NULL
) ;

INSERT INTO `customer` (`customer_id`, `type`, `branch_type`, `regional_branch_id`, `supergrade_branch_id`) VALUES
(4, 'person', 'Supergrade', NULL, 'B002'),
(6, 'business', 'Regional', 'B003', NULL),
(7, 'business', 'Regional', 'B003', NULL),
(8, 'business', 'Regional', 'B005', NULL),
(9, 'business', 'Supergrade', NULL, 'B002'),
(10, 'person', 'Regional', 'B001', NULL),
(11, 'person', 'Regional', 'B001', NULL),
(12, 'business', 'Supergrade', NULL, 'B002'),
(13, 'person', 'Regional', 'B003', NULL),
(14, 'person', 'Regional', 'B003', NULL);

CREATE TABLE `department` (
  `dept_code` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `head` int(11) NOT NULL
);

INSERT INTO `department` (`dept_code`, `type`, `dept_name`, `head`) VALUES
(15, 'Main', 'HR', 15),
(16, 'Main', 'Finance', 5),
(17, 'Main', 'IT', 6),
(18, 'Main', 'Loan handling', 5),
(19, 'Main', 'Investment Department', 6),
(20, 'Sub ', 'Child Savings', 5),
(21, 'Sub ', 'Women savings', 5);

CREATE TABLE `department_contact` (`dept_code` int(11) NOT NULL,`contact_no` int(11) NOT NULL);

INSERT INTO `department_contact` (`dept_code`, `contact_no`) VALUES
(15, 11456235),
(15, 112564892),
(16, 11456235),
(16, 112564892),
(17, 11456235),
(17, 112564892),
(18, 11456235),
(18, 112564892),
(19, 11456235),
(19, 112564892),
(20, 11456235),
(20, 112564892),
(21, 11456235),
(21, 112564892);

CREATE TABLE `department_info` (`dept_code` int(11),`type` varchar(100),`dept_name` varchar(255),`head` int(11));

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `emp_name` varchar(255) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `branch_type` enum('regional','supergrade') NOT NULL,
  `dept_code` int(11) NOT NULL,
  `regional_id` char(5) DEFAULT NULL,
  `supergrade_id` char(5) DEFAULT NULL
) ;

INSERT INTO `employee` (`emp_id`, `dob`, `qualification`, `emp_name`, `nic`, `emp_address`, `type`, `branch_type`, `dept_code`, `regional_id`, `supergrade_id`) VALUES
(5, '1992-10-09', 'Certified', 'Jane Doe', '925449246V', 'Angoda', 'Permanent', 'regional', 15, 'B003', NULL),
(6, '1992-10-13', 'Certified', 'Jack Hills', '925449246V', 'Angoda', 'Intern', 'regional', 15, 'B003', NULL),
(9, '1998-10-08', 'Certified', 'Emma Watson', '98756231V', 'Angoda', 'Other', 'regional', 18, 'B003', NULL),
(10, '1998-09-16', 'Certified', 'Alicia Keys', '987562313V', 'Angoda', 'Permanent', 'supergrade', 20, NULL, 'B002'),
(11, '1998-10-02', 'Certified', 'Michael Dunn', '98756231V', 'Angoda', 'Intern', 'supergrade', 17, NULL, 'B006'),
(12, '1992-09-29', 'Certified', 'Jim Halpert', '925449246V', 'Angoda', 'Intern', 'supergrade', 21, NULL, 'B007'),
(13, '1992-10-01', 'Certified', 'Pamela Beasly', '925449246V', 'Angoda', 'Permanent', 'regional', 20, 'B004', NULL),
(14, '1998-09-29', 'Certified', 'Dwight Schrute', '98756231V', 'Angoda', 'Intern', 'supergrade', 16, NULL, 'B007'),
(15, '1992-09-29', 'Certified', 'Angela Barton', '925449246V', 'Angoda', 'Other', 'supergrade', 21, NULL, 'B007');

CREATE TABLE `employees_per_dept` (`dept_code` int(11),`dept_name` varchar(255),`TYPE` varchar(100),`head` int(11),`number_of_employees` bigint(21));

CREATE TABLE `expired_assignment` (`project_id` int(11),`budget` int(11),`duration` varchar(50),`NAME` varchar(255),`funding_period` varchar(50));

CREATE TABLE `foreign_account` (
  `acc_no` char(5) NOT NULL,
  `details` varchar(255) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `balance` float NOT NULL,
  `branch_type` enum('regional','supergrade') NOT NULL,
  `customer_id` int(11) NOT NULL,
  `regional_id` char(5) DEFAULT NULL,
  `supergrade_id` char(5) DEFAULT NULL
);

INSERT INTO `foreign_account` (`acc_no`, `details`, `unit`, `balance`, `branch_type`, `customer_id`, `regional_id`, `supergrade_id`) VALUES
('AC002', 'Personal', 'USD', 50000, 'regional', 4, 'B001', NULL),
('AC003', 'Company', 'EU', 456000, 'regional', 8, 'B001', NULL),
('AC004', 'Company', 'AUD', 56000, 'supergrade', 9, NULL, 'B002'),
('AC005', 'Personal', 'AUD', 80000, 'supergrade', 4, NULL, 'B002'),
('AC006', 'Company', 'USD', 1000, 'regional', 12, 'B001', NULL);

CREATE TABLE `foreign_accounts_per_cus` (`customer_id` int(11),`no_of_accounts` bigint(21));

CREATE TABLE `intern` (
  `emp_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `period` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `salary_scale` varchar(100) NOT NULL
);

INSERT INTO `intern` (`emp_id`, `temp_id`, `period`, `start_date`, `salary_scale`) VALUES
(6, 12, '12', '2020-10-11', '500000'),
(11, 12, '6', '2020-10-07', '5000'),
(12, 12, '12', '2020-09-27', '50000'),
(14, 12, '6', '2020-09-08', '50000');

CREATE TABLE `ministry` (`ministry_code` int(11) NOT NULL,`name` varchar(255) NOT NULL);

INSERT INTO `ministry` (`ministry_code`, `name`) VALUES(1, 'Ministry of Education'),(2, 'Ministry of health');

CREATE TABLE `ministry_assignment` (`ministry_code` int(11) NOT NULL,`project_id` int(11) NOT NULL);

INSERT INTO `ministry_assignment` (`ministry_code`, `project_id`) VALUES
(1, 10),
(1, 11),
(1, 15),
(1, 17);

CREATE TABLE `permanent_employee` (`emp_id` int(11) NOT NULL,`basic_salary` int(11) NOT NULL,`grade` varchar(50) NOT NULL);

INSERT INTO `permanent_employee` (`emp_id`, `basic_salary`, `grade`) VALUES
(5, 50000, 'A'),
(10, 60000, 'C'),
(13, 500000, 'A');

CREATE TABLE `person` (
  `nic` varchar(12) NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `address_lines` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL
);

INSERT INTO `person` (`nic`, `person_name`, `address_lines`, `city`, `province`, `zip_code`, `customer_id`) VALUES
('925449246V', 'Jane Smith', 'Angoda', 'New Town', 'Colombo', 'C562', 4),
('925449247V', 'Andy Bernard', 'Angoda', 'New Town', 'Colombo', 'C562', 11),
('925449248V', 'Ryan Gosling', 'Kollupitiya', 'Colombo 06', 'Colombo', 'Z568', 14);

CREATE TABLE `regional_branch` (
  `branch_id` char(5) NOT NULL,
  `building_area` varchar(255) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `temp_debt` int(11) DEFAULT NULL,
  `regional_code` varchar(10) DEFAULT NULL
);

INSERT INTO `regional_branch` (`branch_id`, `building_area`, `branch_name`, `location`, `temp_debt`, `regional_code`) VALUES
('B001', 'Top floor', 'Branch A', 'Colombo, Sri Lanka', 50000, 'Reg025'),
('B003', 'North Wing', 'Kollupitiya A', 'Colombo 08', 100000, 'Reg003'),
('B004', 'North Wing', 'Branch C', 'Colombo 05', 4000, 'Reg456'),
('B005', 'North Wing', 'Colombo Super', 'Colombo, Sri Lanka', 1155500, 'Reg003');

CREATE TABLE `residential_account` (
  `acc_no` char(5) NOT NULL,
  `details` varchar(255) NOT NULL,
  `residential_type` varchar(100) NOT NULL,
  `balance` float NOT NULL,
  `customer_id` int(11) NOT NULL,
  `branch_type` enum('regional','supergrade') NOT NULL,
  `regional_id` char(5) DEFAULT NULL,
  `supergrade_id` char(5) DEFAULT NULL
) ;

INSERT INTO `residential_account` (`acc_no`, `details`, `residential_type`, `balance`, `customer_id`, `branch_type`, `regional_id`, `supergrade_id`) VALUES
('AC001', 'Fixed Deposit', 'Savings', 1000, 4, 'supergrade', NULL, 'B002'),
('AC007', 'Personal Savings', 'Savings', 12000, 11, 'supergrade', NULL, 'B002'),
('AC008', 'Personal', 'Current', 45000, 14, 'regional', 'B004', NULL);

CREATE TABLE `supergrade_branch` (
  `branch_id` char(5) NOT NULL,
  `building_area` varchar(255) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `main_city` varchar(50) DEFAULT NULL
);

INSERT INTO `supergrade_branch` (`branch_id`, `building_area`, `branch_name`, `location`, `main_city`) VALUES
('B002', 'Top floor', 'Head Office', 'Town Hall', 'Town Hall'),
('B006', 'North Wing', 'Branch E', 'Colombo, Sri Lanka', 'New Town'),
('B007', 'Top floor', 'Branch Z', 'Colombo 06', 'Colombo 06');
DROP TABLE IF EXISTS `assignments_per_department`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `assignments_per_department`  AS  select `d`.`dept_code` AS `dept_code`,`d`.`dept_name` AS `dept_name`,`d`.`type` AS `TYPE`,`d`.`head` AS `head`,`a`.`number_of_assignments` AS `number_of_assignments`,`a`.`total_budget` AS `total_budget` from (`department` `d` join (select `assignment`.`dept_code` AS `dept_code`,count(`assignment`.`dept_code`) AS `number_of_assignments`,sum(`assignment`.`budget`) AS `total_budget` from `assignment` group by `assignment`.`dept_code`) `a` on(`d`.`dept_code` = `a`.`dept_code`)) ;
DROP TABLE IF EXISTS `department_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `department_info`  AS  select `department`.`dept_code` AS `dept_code`,`department`.`type` AS `type`,`department`.`dept_name` AS `dept_name`,`department`.`head` AS `head` from `department` ;
DROP TABLE IF EXISTS `employees_per_dept`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employees_per_dept`  AS  select `d`.`dept_code` AS `dept_code`,`d`.`dept_name` AS `dept_name`,`d`.`type` AS `TYPE`,`d`.`head` AS `head`,`e`.`number_of_employees` AS `number_of_employees` from (`department` `d` join (select count(`employee`.`dept_code`) AS `number_of_employees`,`employee`.`dept_code` AS `dept_code` from `employee` group by `employee`.`dept_code`) `e` on(`d`.`dept_code` = `e`.`dept_code`)) ;
DROP TABLE IF EXISTS `expired_assignment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expired_assignment`  AS  select `assignment`.`project_id` AS `project_id`,`assignment`.`budget` AS `budget`,`assignment`.`duration` AS `duration`,`assignment`.`name` AS `NAME`,`assignment`.`funding_period` AS `funding_period` from `assignment` where `assignment`.`thirdparty_flag` = 1 and `assignment`.`funding_period` < `assignment`.`duration` ;
DROP TABLE IF EXISTS `foreign_accounts_per_cus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `foreign_accounts_per_cus`  AS  select `foreign_account`.`customer_id` AS `customer_id`,count(`foreign_account`.`customer_id`) AS `no_of_accounts` from `foreign_account` group by `foreign_account`.`customer_id` ;


ALTER TABLE `assignment`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `dept_code` (`dept_code`);

ALTER TABLE `business`
  ADD PRIMARY KEY (`br_no`),
  ADD KEY `customer_id` (`customer_id`);

ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

ALTER TABLE `company_assignment`
  ADD PRIMARY KEY (`company_id`,`project_id`),
  ADD KEY `project_id` (`project_id`);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `regional_branch_id` (`regional_branch_id`),
  ADD KEY `supergrade_branch_id` (`supergrade_branch_id`);

ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_code`),
  ADD KEY `head` (`head`);

ALTER TABLE `department_contact`
  ADD PRIMARY KEY (`dept_code`,`contact_no`);

ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `regional_id` (`regional_id`),
  ADD KEY `supergrade_id` (`supergrade_id`),
  ADD KEY `dept_code` (`dept_code`);

ALTER TABLE `foreign_account`
  ADD PRIMARY KEY (`acc_no`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `regional_id` (`regional_id`),
  ADD KEY `supergrade_id` (`supergrade_id`);

ALTER TABLE `intern`
  ADD PRIMARY KEY (`emp_id`);

ALTER TABLE `ministry`
  ADD PRIMARY KEY (`ministry_code`);

ALTER TABLE `ministry_assignment`
  ADD PRIMARY KEY (`ministry_code`,`project_id`),
  ADD KEY `project_id` (`project_id`);

ALTER TABLE `permanent_employee`
  ADD PRIMARY KEY (`emp_id`);

ALTER TABLE `person`
  ADD PRIMARY KEY (`nic`),
  ADD KEY `customer_id` (`customer_id`);

ALTER TABLE `regional_branch`
  ADD PRIMARY KEY (`branch_id`);

ALTER TABLE `residential_account`
  ADD PRIMARY KEY (`acc_no`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `regional_id` (`regional_id`),
  ADD KEY `supergrade_id` (`supergrade_id`);

ALTER TABLE `supergrade_branch`
  ADD PRIMARY KEY (`branch_id`);


ALTER TABLE `assignment`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `department`
  MODIFY `dept_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ministry`
  MODIFY `ministry_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`dept_code`) REFERENCES `department` (`dept_code`);

ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

ALTER TABLE `company_assignment`
  ADD CONSTRAINT `company_assignment_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `assignment` (`project_id`),
  ADD CONSTRAINT `company_assignment_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`);

ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`regional_branch_id`) REFERENCES `regional_branch` (`branch_id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`supergrade_branch_id`) REFERENCES `supergrade_branch` (`branch_id`);

ALTER TABLE `department_contact`
  ADD CONSTRAINT `department_contact_ibfk_1` FOREIGN KEY (`dept_code`) REFERENCES `department` (`dept_code`);

ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`regional_id`) REFERENCES `regional_branch` (`branch_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`supergrade_id`) REFERENCES `supergrade_branch` (`branch_id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`dept_code`) REFERENCES `department` (`dept_code`);

ALTER TABLE `foreign_account`
  ADD CONSTRAINT `foreign_account_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `foreign_account_ibfk_2` FOREIGN KEY (`regional_id`) REFERENCES `regional_branch` (`branch_id`),
  ADD CONSTRAINT `foreign_account_ibfk_3` FOREIGN KEY (`supergrade_id`) REFERENCES `supergrade_branch` (`branch_id`);

ALTER TABLE `intern`
  ADD CONSTRAINT `intern_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

ALTER TABLE `ministry_assignment`
  ADD CONSTRAINT `ministry_assignment_ibfk_1` FOREIGN KEY (`ministry_code`) REFERENCES `ministry` (`ministry_code`),
  ADD CONSTRAINT `ministry_assignment_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `assignment` (`project_id`);

ALTER TABLE `permanent_employee`
  ADD CONSTRAINT `permanent_employee_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

ALTER TABLE `residential_account`
  ADD CONSTRAINT `residential_account_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `residential_account_ibfk_2` FOREIGN KEY (`regional_id`) REFERENCES `regional_branch` (`branch_id`),
  ADD CONSTRAINT `residential_account_ibfk_3` FOREIGN KEY (`supergrade_id`) REFERENCES `supergrade_branch` (`branch_id`);

# Privileges for `admin`@`%`

GRANT USAGE ON *.* TO `admin`@`%` IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

GRANT SELECT ON `bankofasia`.`department_info` TO `admin`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`supergrade_branch` TO `admin`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `bankofasia`.`regional_branch` TO `admin`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `bankofasia`.`department` TO `admin`@`%`;

GRANT SELECT ON `bankofasia`.`intern` TO `admin`@`%`;

GRANT SELECT ON `bankofasia`.`assignments_per_department` TO `admin`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`department_contact` TO `admin`@`%`;

GRANT SELECT ON `bankofasia`.`employee` TO `admin`@`%`;

GRANT SELECT ON `bankofasia`.`permanent_employee` TO `admin`@`%`;


# Privileges for `employee`@`%`

GRANT USAGE ON *.* TO `employee`@`%` IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`foreign_account` TO `employee`@`%`;

GRANT SELECT, INSERT, UPDATE ON `bankofasia`.`customer` TO `employee`@`%`;

GRANT SELECT, INSERT, UPDATE ON `bankofasia`.`person` TO `employee`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`residential_account` TO `employee`@`%`;

GRANT SELECT ON `bankofasia`.`supergrade_branch` TO `employee`@`%`;

GRANT SELECT ON `bankofasia`.`regional_branch` TO `employee`@`%`;

GRANT SELECT ON `bankofasia`.`foreign_accounts_per_cus` TO `employee`@`%`;

GRANT SELECT, INSERT, UPDATE ON `bankofasia`.`business` TO `employee`@`%`;


# Privileges for `hr`@`%`

GRANT USAGE ON *.* TO `hr`@`%` IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

GRANT SELECT ON `bankofasia`.`supergrade_branch` TO `hr`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`intern` TO `hr`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`employee` TO `hr`@`%`;

GRANT SELECT ON `bankofasia`.`employees_per_dept` TO `hr`@`%`;

GRANT SELECT ON `bankofasia`.`department` TO `hr`@`%`;

GRANT SELECT ON `bankofasia`.`regional_branch` TO `hr`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`permanent_employee` TO `hr`@`%`;


# Privileges for `manager`@`%`

GRANT USAGE ON *.* TO `manager`@`%` IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

GRANT SELECT, DELETE ON `bankofasia`.`customer` TO `manager`@`%`;

GRANT SELECT, UPDATE, DELETE ON `bankofasia`.`regional_branch` TO `manager`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `bankofasia`.`ministry_assignment` TO `manager`@`%`;

GRANT SELECT ON `bankofasia`.`ministry` TO `manager`@`%`;

GRANT DELETE ON `bankofasia`.`business` TO `manager`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `bankofasia`.`assignment` TO `manager`@`%`;

GRANT SELECT, UPDATE, DELETE ON `bankofasia`.`supergrade_branch` TO `manager`@`%`;

GRANT SELECT ON `bankofasia`.`company` TO `manager`@`%`;

GRANT SELECT ON `bankofasia`.`department` TO `manager`@`%`;

GRANT SELECT ON `bankofasia`.`expired_assignment` TO `manager`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE, REFERENCES ON `bankofasia`.`company_assignment` TO `manager`@`%`;

GRANT DELETE ON `bankofasia`.`person` TO `manager`@`%`;


