

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `abbchmprmdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `abbchmprmdb`;

-- -----------------------------------------------------
-- Table `user_tbl`
-- create for reports module (for authenticating users to access reports)
-- -----------------------------------------------------

DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE IF NOT EXISTS `user_tbl` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(150) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NULL,
  `password` varchar(200) NOT NULL,
  `phone_number` varchar(25) NULL,
  `organization` varchar(250) NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture_filename` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



--------------------------------------------------------------------------------------------
-- schooltype_tbl
-- created for reports module (to provide drop-down select in where-clause for report) --
--------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `schooltype_tbl` ;
CREATE  TABLE IF NOT EXISTS `schooltype_tbl` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `school_type` TINYINT NOT NULL,
  `description` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

INSERT INTO `schooltype_tbl` (`school_type`,`description`) VALUES
(0,'Government'),
(1,'Private');


-- -----------------------------------------------------
-- PRACTICE MODE REPORTS TABLES
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `reports_prm_groups_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reports_prm_groups_tbl`;
CREATE TABLE IF NOT EXISTS `reports_prm_groups_tbl` (
  `report_group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL  default 1,
  PRIMARY KEY  (`report_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

-- -----------------------------------------------------
-- Table `reports_prm_tbl`
-- view_name: the view from which this report will fetch records
-- uniquevaluecolumnname: The column of the 'view' used for this report that will have unique values 
-- (as there is no 'primary key' for views, this column will be used to do counts of total records while fetching values for the datatable through ajax (used in server_processing class))
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reports_prm_tbl`;
CREATE TABLE IF NOT EXISTS `reports_prm_tbl` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_code` varchar(50) NOT NULL,
  `report_name` varchar(100) NOT NULL,
  `view_name` varchar(60) NOT NULL,
  `uniquevaluecolumnname` varchar(100) NOT NULL, 
  `report_description` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL COMMENT 'Id of the report group to which this report belongs to',
  `is_active` tinyint(1) NOT NULL default 1,
  `display_order` int(11) NOT NULL default '1',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `report_prm_columns_tbl`
-- report_column_name entry should be same as that in the associated view
-- -----------------------------------------------------
DROP TABLE IF EXISTS `report_prm_columns_tbl`;
CREATE TABLE IF NOT EXISTS `report_prm_columns_tbl` (
  `report_column_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `report_column_seqid` int(11) NOT NULL,
  `report_column_name` varchar(60) NOT NULL,
  `report_column_label` varchar(60) DEFAULT NULL COMMENT 'stores the column lable as it appears in the report header',
  `column_datatype` varchar(20) NOT NULL,
  PRIMARY KEY (`report_column_auto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;


-- -----------------------------------------------------
-- Table `report_prm_whereclause_tbl`
-- (For filters)
-- report_whereclause_column_name entry should be same as that in the associated view
-- -----------------------------------------------------
DROP TABLE IF EXISTS `report_prm_whereclause_tbl`;
CREATE TABLE IF NOT EXISTS `report_prm_whereclause_tbl` (
  `report_whereclause_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `report_whereclause_seqid` int(11) NOT NULL,
  `report_whereclause_column_name` varchar(60) NOT NULL,
  `report_whereclause_column_label` varchar(60) DEFAULT NULL COMMENT 'The column name as it appears in the UI',
  `wc_datatype` varchar(20) NOT NULL,
  `column_data_prefix` varchar(30) DEFAULT NULL,
  `default_value` varchar(50) default NULL COMMENT 'Default value for the whereclause field (the value entered here will be used as the default value, except if the value is  ''CURRENTDATE'' . For ''CURRENTDATE'', the actual date is shown as the default value)',
  PRIMARY KEY (`report_whereclause_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


-- -----------------------------------------------------
-- Table `report_prm_master_wc_tbl`
-- To store all the table keys and values so that reports whereclause values can be rendered on the screen wth drop down values for such FKs
--
-- Whenever the report_whereclause_tbl has a field with wc_coulm_name for a report, the report whereclause selection 
-- drop-down will show all the values in the table table_name in the column with fieldname support_column_name in the selection drop-down boxas possible values
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reports_prm_master_wc_tbl`;
CREATE TABLE IF NOT EXISTS `report_prm_master_wc_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(70) NOT NULL,
  `wc_column_name` varchar(70) NOT NULL,
  `support_column_name` varchar(70) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ---------------------------------------------------------
--          Table - charts_prm_tbl
-- is_dashboard - whether this chart is being displayed on the Dashboard
-- maxrecordstodisplay - The View may have more records (to be used for Reports) than required for Chart.
--                       Will fetch only last 'maxrecordstodisplay' to show in the Chart
-- maxrecordsfrom - pick 'maxrecrodstodisplay' starting from top or bottom ('top' or 'bottom')
-- orderby_columnname - This is the name of the column in the View which should be used to 'order by' to fetch last 'maxrecordstodisplay' number of records
-- ----------------------------------------------------------

DROP TABLE IF EXISTS `charts_prm_tbl`;
CREATE TABLE IF NOT EXISTS `charts_prm_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_name` varchar(256) NOT NULL,
  `chart_description` varchar(512) NOT NULL, 
  `view_name` varchar(256) NOT NULL,
  `maxrecordstodisplay` int(11) NOT NULL, 
  `maxrecordsfrom` varchar(100) NOT NULL,
  `orderby_columnname` varchar(100) NOT NULL,
  `is_dashboard` tinyint(1) NOT NULL default 1,
  `display_order` int(11) NOT NULL default '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------
--          PRACTICE REPORTS MASTER DATA
------------------------------------------------------------

INSERT INTO `reports_prm_groups_tbl` (`report_group_id`, `group_name`, `display_order`) VALUES
(1, 'User Reports', 1),
(2, 'Engagement Reports', 2),
(3, 'Learning Outcome Metrics Reports', 3),
(4, 'App Usage Metrics Reports', 4);

INSERT INTO `reports_prm_tbl` (`report_id`, `report_code`, `report_name`, `view_name`, `uniquevaluecolumnname`, `report_description`, `group_id`, `is_active`, `display_order`) VALUES
(1, 'USRRPT1', 'Registered Users', 'emrp_active_users_view', 'childid', 'Details of all the registered Children',1,0,1),
(2, 'USRRPT2', 'Daily Registration Stats', 'emrp_dailyregistration_view','RegDate', 'Daily Registration Statistics',1,0,2),
(3, 'USRRPT3', 'Weekly Registration Stats', 'emrp_weeklyregistration_view','RegWeek', 'Weekly Registration Statistics',1,0,3),
(4, 'USRRPT4', 'Monthly Registration Stats', 'emrp_monthlyregistration_view','RegMonth', 'Monthly Registration Statistics',1,0,4),

(5, 'ENGRPT1', 'Daily Game Play Session Stats', 'prm_dailygameplaysessions_view','SessionDate', 'Daily Game Play Session Statistics',2,1,1),
(6, 'LOMRPT1', 'Competency Level Summary', 'prm_attemptssummaryallgames_view', 'attempts','Competency Level in terms of number of successful submission in #N attempts',3,1,1),
(7, 'AUMRPT1', 'Avg. Play Session Time', 'prm_avggameplaysessiontimeperchild_view','childid', 'Average session time across all game play sessions played by a Child ',4,1,2),
(8, 'AUMRPT2', 'Game Utilization Metrics', 'prm_totalsessionspergame_view','GameId','Total number of play sessions for each of the Games',4,1,3),
(9, 'AUMRPT3', 'Game Play Sessions (Last 2 Wks)', 'prm_childtimepergameplaysession_view', 'id_game_play', 'Game Play Sessions played by each Child during the last two weeks',4,1,4),
(10, 'USRRPT5', 'Monthly Registration Stats by Organization', 'prm_monthlyregistration_orgvise_view','Organization', 'Organization-vise Registration Stats',1,1,5),
(11, 'ENGRPT2', 'Monthly Game Play Session Stats', 'prm_monthlygameplaysessions_view','Month', 'Monthly Game Play Session Statistics',2,1,2),
(12, 'ENGRPT3', 'Monthly Game Play Session Stats Child-vise', 'prm_monthlygameplaysessions_childvise_view','Month', 'Monthly Game Play Session Statistics per Child',2,1,3),
(13, 'ENGRPT4', 'Monthly Game Play Session Stats Organization-vise', 'prm_monthlygameplaysessions_orgvise_view','Month', 'Monthly Game Play Session Statistics per Organization',2,1,4),
(14, 'ENGRPT5', 'Questions with more number of attempts', 'prm_questionsubmissionsandattemptscounts_view','QuestionID', 'List of Questions with the number of Submissions that had 4 or more attempts',2,1,5),
(15, 'AUMRPT4', 'Daily Total Game Play Session time per Child', 'prm_dailytotalsessiontimeperchild_view','dateplayed', 'Total Game Play Session time per Child per Day for the last one Month',4,1,1),
(16, 'USRRPT6', 'Active Devices','prm_activedevices_view','DeviceId','List of Devices logged-in at least once every week during the last 4 weeks',1,1,6),
(17, 'ENGRPT6', 'Weekly Game Play Sessions Device-vise', 'prm_weeklygameplaysessions_perdevice_view','DeviceId', 'Total Game Play Sessions count per Device per Week during the last 6 months',2,1,6);




-- report_column_name entry should be same as that in the associated view
INSERT INTO `report_prm_columns_tbl` (`report_id`, `report_column_seqid`, `report_column_name`, `report_column_label`, `column_datatype`) VALUES
(1, 1, 'Name', 'Name', 'varchar'),
(1, 2, 'DeviceId', 'DeviceId', 'varchar'),
(1, 3, 'Grade', 'Grade', 'varchar'),
(1, 4, 'Language', 'Language', 'varchar'),
(1, 5, 'SchoolType', 'School Type', 'varchar'),
(1, 6, 'Organization', 'Organization', 'varchar'),
(1, 7, 'District', 'District', 'varchar'),
(1, 8, 'Created_Datetime', 'Date', 'datetime'),

(2, 1, 'RegDate', 'Date', 'datetime'),
(2, 2, 'RegistrationCount', '#Registrations', 'integer'),

(3, 1, 'RegWeek', 'Week', 'varchar'),
(3, 2, 'RegistrationCount', '#Registrations', 'integer'),

(4, 1, 'RegMonth', 'Month', 'varchar'),
(4, 2, 'RegistrationCount', '#Registrations', 'integer'),

(5, 1, 'SessionDate','Date','datetime'),
(5, 2, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(6, 1, 'attempts','#Attempts','integer'),
(6, 2, 'submissioncount','Submissions Count','integer'),

(7, 1, 'Name','Name','varchar'),
(7, 2, 'DeviceId','DeviceId','varchar'),
(7, 3, 'Grade','Grade','varchar'),
(7, 4, 'Organization','Organization','varchar'),
(7, 5, 'Total_Gameplay_Session_Time','Total Session Time','integer'),
(7, 6, 'Number_Of_Gameplay_Sessions','Number of Sessions','integer'),
(7, 7, 'Avg_Gameplay_Session_Time','Avg Session Time','integer'),
(7, 8, 'date_last_played','Last Played On','datetime'),

(8, 1, 'GameId','GameId','varchar'),
(8, 2, 'PlaySessions','Play Sessions','integer'),


(9, 1, 'Name','Name','varchar'),
(9, 2, 'DeviceId','DeviceId','varchar'),
(9, 3, 'Organization','Organization','varchar'),
(9, 4, 'id_game','GameId','varchar'),
(9, 5, 'session_start_time','Session Date','datetime'),
(9, 6, 'total_session_time','Total Session Time','integer'),

(10, 1, 'Organization', 'Organization', 'varchar'),
(10, 2, 'RegMonth', 'Month', 'varchar'),
(10, 3, 'RegYear', 'Year', 'varchar'),
(10, 4, 'RegistrationCount', '#Registrations', 'integer'),

(11, 1, 'Month','Month','integer'),
(11, 2, 'Year','Year','integer'),
(11, 3, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(12, 1, 'Name','Name','varchar'),
(12, 2, 'DeviceId','DeviceId','varchar'),
(12, 3, 'Organization','Organization','varchar'),
(12, 4, 'Month','Month','integer'),
(12, 5, 'Year','Year','integer'),
(12, 6, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(13, 1, 'Organization','Organization','varchar'),
(13, 2, 'Month','Month','integer'),
(13, 3, 'Year','Year','integer'),
(13, 4, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(14, 1, 'QuestionID','Question ID','varchar'),
(14, 2, 'totalsubmissions','Total #Submissions','integer'),
(14, 3, 'submissionswith4ormoreattempts','#Submissions with >3 Attempts','integer'),

(15, 1, 'dateplayed','Date','datetime'),
(15, 2, 'DeviceId','DeviceId','varchar'),
(15, 3, 'Name','Name','varchar'),
(15, 4, 'Grade','Grade','varchar'),
(15, 5, 'Organization','Organization','varchar'),
(15, 6, 'Total_Gameplay_Session_Time','Total Session Time','integer'),

(16, 1, 'DeviceId','DeviceId','varchar'),
(16, 2, 'Users','Users','integer'),
(16, 3, 'Week1','Wk1Sessions','integer'),
(16, 4, 'Week2','Wk2Sessions','integer'),
(16, 5, 'Week3','Wk3Sessions','integer'),
(16, 6, 'Week4','Wk4Sessions','integer'),
(16, 7, 'TotalSessionsCount','Total Sessions Count','integer'),

(17, 1, 'DeviceId','DeviceId','varchar'),
(17, 2, 'Users','Users','integer'),
(17, 3, 'Week','Week','integer'),
(17, 4, 'Year','Year','integer'),
(17, 5, 'WeekStartDate','Week Start Date','datetime'),
(17, 6, 'GameplaySessionsWeeklyCount','Weekly Sessions Count','integer');



-- report_whereclause_column_name entry should be same as that in the associated view
INSERT INTO `report_prm_whereclause_tbl` (`report_id`, `report_whereclause_seqid`, `report_whereclause_column_name`, `report_whereclause_column_label`, `wc_datatype`, `column_data_prefix`, `default_value`) VALUES
(1, 1, 'Grade', 'Grade', 'varchar', NULL, NULL),
(1, 2, 'Language', 'Language', 'varchar', NULL, NULL),
(1, 3, 'Created_Datetime', 'Reg. Date', 'datetime', NULL, NULL),
(1, 4, 'Organization', 'Organization', 'varchar', NULL, NULL),
(1, 5, 'District', 'District', 'varchar', NULL, NULL),
(2, 1, 'RegDate','Registration Date','datetime',NULL,NULL),
(5, 1, 'SessionDate','Session Date','datetime',NULL,NULL),
(6, 1, 'attempts','Attempts','integer',NULL,NULL),
(7, 1, 'Grade','Grade','varchar',NULL,NULL),
(7, 2, 'Organization','Organization','varchar',NULL,NULL),
(7, 3, 'Number_Of_Gameplay_Sessions','Number of Sessions','integer',NULL,NULL),
(7, 4, 'date_last_played','Last Played On','datetime',NULL,NULL),
(8, 1, 'GameId','GameId','varchar',NULL,NULL),
(9, 1, 'Name','Name','varchar',NULL,NULL),
(9, 2, 'DeviceId','DeviceId','varchar',NULL,NULL),
(9, 3, 'Organization','Organization','varchar',NULL,NULL),
(9, 4, 'id_game','GameId','varchar',NULL,NULL),
(9, 5, 'session_start_time','Session Date','datetime',NULL,NULL),
(9, 6, 'total_session_time','Total Session Time','integer',NULL,NULL),
(10, 1, 'Organization', 'Organization', 'varchar', NULL, NULL),
(12, 1, 'Organization', 'Organization', 'varchar', NULL, NULL),
(13, 1, 'Organization', 'Organization', 'varchar', NULL, NULL),
(14, 1, 'submissionswith4ormoreattempts','#Submissions (with >3 attempts)','integer',NULL,NULL),
(14, 2, 'totalsubmissions','Total #Submissions','integer',NULL,NULL),
(15, 1, 'Name','Name','varchar',NULL,NULL),
(15, 2, 'DeviceId','DeviceId','varchar',NULL,NULL),
(15, 3, 'Grade','Grade','varchar',NULL,NULL),
(15, 4, 'Organization','Organization','varchar',NULL,NULL),
(15, 5, 'dateplayed','Date','datetime',NULL,NULL),
(17, 1, 'WeekStartDate','Week Start Date','datetime',NULL,NULL);

-- If the report_prm_whereclause_tbl has an entry equal to wc_column_name, read all the values in the support_column_name in the table (specified by the table_name) and present in the drop-down selection box
INSERT INTO `report_prm_master_wc_tbl` (`id`, `table_name`, `wc_column_name`, `support_column_name`) VALUES
(1, 'grade_tbl', 'Grade', 'description'),
(2, 'language_tbl', 'Language', 'description');

-- ---------------------------------------------------------
--         PRACTICE MODE CHARTS MASTER DATA
------------------------------------------------------------

INSERT INTO `charts_prm_tbl` (`chart_name`, `chart_description`,`view_name`,`maxrecordstodisplay`,`maxrecordsfrom`,`orderby_columnname`,`is_dashboard`,`display_order`) VALUES
('Game utilization', 'Total number of play sessions for various Games','prm_totalsessionspergame_view',40,'top','PlaySessions', 0,1),
('Weekly Registration Stats', 'Registrations per week for the last 12 weeks','emrp_weeklyregistration_view',12,'bottom','RegWeek', 1,2),
('Daily Game Play Sessions', 'Game Play Sessions per day for the last 30 days','prm_dailygameplaysessions_view',15,'bottom','SessionDate',1,3),
('Competency Level Summary', 'Overall competency level summary based on number submissions against number of attempts across all answe submissions in all the game play sessions across all games','prm_attemptssummaryallgames_view',5,'top','attempts',1,4),
('Govt-Pvt School Distribution', 'Govt vs Pvt Schooltype Child Distribution','emrp_schooltypewisechildcount_view',2,'top','schooltypeid',1,5);




-- ---------------------------------------------------------
--          REPORTS VIEWS
------------------------------------------------------------


-- ---------------------------------------------------------
--          VIEW: emrp_active_users_view
------------------------------------------------------------

DROP view IF EXISTS emrp_active_users_view;
create view emrp_active_users_view as
select
ch.id_child as childid,
ch.child_name as Name,
ch.deviceid as DeviceId,
gr.description as Grade,
ln.description as Language,
sc.description as SchoolType,
ch.organization as Organization,
ch.district as District,
ch.created_datetime as Created_Datetime
 
from
child_tbl ch,
grade_tbl gr,
language_tbl ln,
schooltype_tbl sc

where
ch.id_grade = gr.id_grade and
ch.id_language = ln.id_language and
ch.school_type = sc.school_type;

-- ---------------------------------------------------------
--          VIEW: emrp_weeklyregistration_view
-- Number of registrations per week for the last 12 weeks
-- The view will have 'RegWeek' as the number of the week in the year (1-53) (week starting on Sunday by default)
-- and the total registration count in that week. 
-- If there is no registration in a particular week, there will be no entry for that week
-- ----------------------------------------------------------

DROP view IF EXISTS `emrp_weeklyregistration_view`;
create view emrp_weeklyregistration_view as

 SELECT  
 WEEK(ch.created_datetime) as RegWeek,
 YEAR(ch.created_datetime) as RegYear,
 COUNT(if (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 1 WEEK) AND NOW(), ch.id_child,0)) AS `RegistrationCount`

 FROM `child_tbl` ch
 WHERE (DATE(ch.created_datetime) BETWEEN (NOW()-INTERVAL 12 WEEK) AND NOW()) 
 GROUP BY RegWeek, RegYear
 ORDER BY RegWeek ASC;
 
-- ---------------------------------------------------------
--          VIEW: emrp_dailyregistration_view
-- Number of registrations per day for the last 30 days
-- ----------------------------------------------------------

DROP view IF EXISTS `emrp_dailyregistration_view`;
create view emrp_dailyregistration_view as

 SELECT  
 DATE(created_datetime) as RegDate,
 COUNT(if (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 1 DAY) AND NOW(), id_child,0)) AS `RegistrationCount`

 FROM `child_tbl`  
 WHERE (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 30 DAY) AND NOW()) 
 GROUP BY RegDate
 ORDER BY RegDate ASC;
 
-- ---------------------------------------------------------
--          VIEW: emrp_monthlyregistration_view
-- Number of registrations per month for the last 12 months
-- The view will have 'RegMonth' as the number of the month in the year (1-12)
-- and the total registration count in that month. 
-- If there is no registration in a particular week, there will be no entry for that week
-- ----------------------------------------------------------

DROP view IF EXISTS `emrp_monthlyregistration_view`;
create view emrp_monthlyregistration_view as

 SELECT  
 MONTH(created_datetime) as RegMonth,
 YEAR(created_datetime) as RegYear,
 COUNT(if (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW(), id_child,0)) AS `RegistrationCount`

 FROM `child_tbl`  
 WHERE (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 12 MONTH) AND NOW()) 
 GROUP BY RegMonth, RegYear
 ORDER BY RegMonth ASC;
 
 -- ---------------------------------------------------------
--          VIEW: emrp_monthlyregistration_orgvise_view
-- Number of total registrations against each Organization Month-vise for last 12 months
-- ----------------------------------------------------------

DROP view IF EXISTS `emrp_monthlyregistration_orgvise_view`;
create view emrp_monthlyregistration_orgvise_view as

 SELECT  
 organization as Organization,
 MONTH(created_datetime) as RegMonth,
 YEAR(created_datetime) as RegYear,
 COUNT(if (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW(), id_child,0)) AS `RegistrationCount`

 FROM `child_tbl`  
 WHERE (DATE(created_datetime) BETWEEN (NOW()-INTERVAL 12 MONTH) AND NOW()) 
 GROUP BY Organization, RegMonth, RegYear
 ORDER BY Organization, RegMonth, RegYear ASC;
 
 -- ---------------------------------------------------------
--          VIEW: emrp_schooltypewisechildcount_view
-- Number of children registered from Government school vs Private school
-- (MySQL5.7 onwards, if there is an aggregate statement (SUM, COUNT etc), all the columns in SELECT should be in GROUP BY, otherwise gives error. Hence put description in GROUP BY clause
-- ------------------------------------------------------------
  
DROP view IF EXISTS `emrp_schooltypewisechildcount_view`;
create view emrp_schooltypewisechildcount_view as
SELECT 
   child_tbl.school_type as schooltypeid,
   schooltype_tbl.description as 'School Type',
   COUNT(child_tbl.id_child) as 'Child Count'
FROM
   child_tbl, schooltype_tbl
WHERE child_tbl.school_type = schooltype_tbl.school_type
GROUP BY child_tbl.school_type, schooltype_tbl.description
ORDER BY child_tbl.school_type

-- ---------------------------------------------------------
--          VIEW: prm_dailygameplaysessions_view
-- Number of game sessions played per day for the last 1 year
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `prm_dailygameplaysessions_view`;
create view prm_dailygameplaysessions_view as

SELECT
 DATE(start_time) as SessionDate,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 DAY) AND NOW(), id_game_play,0)) AS `GameplaySessionsCount`

 FROM `game_play_tbl`  
 WHERE (DATE(start_time) BETWEEN (NOW()-INTERVAL 365 DAY) AND NOW()) 
 GROUP BY SessionDate
 ORDER BY SessionDate ASC;
 
-- ---------------------------------------------------------
--          VIEW: prm_monthlygameplaysessions_view
-- Number of game sessions played per Month for the last 1 year
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `prm_monthlygameplaysessions_view`;
create view prm_monthlygameplaysessions_view as

SELECT
 MONTH(start_time) as Month,
 YEAR(start_time) as  Year,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW(), id_game_play,0)) AS `GameplaySessionsCount`

 FROM `game_play_tbl`  
 WHERE (DATE(start_time) BETWEEN (NOW()-INTERVAL 12 MONTH) AND NOW()) 
 GROUP BY Month, Year
 ORDER BY Month, Year ASC;
 
 -- ---------------------------------------------------------
--          VIEW: prm_monthlygameplaysessions_childvise_view
-- Number of game sessions played per Month per Child for the last 1 year
-- (This view is used for creating emrp_chart_monthlygameplaysessions_orgvise_view
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `prm_monthlygameplaysessions_childvise_view`;
create view prm_monthlygameplaysessions_childvise_view as

SELECT
 child_tbl.id_child as id_child,
 child_tbl.child_name as Name,
 child_tbl.deviceid as DeviceId,
 child_tbl.organization as Organization,
 MONTH(game_play_tbl.start_time) as Month,
 YEAR(game_play_tbl.start_time) as  Year,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW(), id_game_play,0)) AS `GameplaySessionsCount`

 FROM `child_tbl`, `game_play_tbl`  
 WHERE (child_tbl.id_child = game_play_tbl.id_child) AND (DATE(start_time) BETWEEN (NOW()-INTERVAL 12 MONTH) AND NOW()) 
 GROUP BY id_child, Name, Month, Year
 ORDER BY id_child, Name, Month, Year ASC;
 
 -- ---------------------------------------------------------
--          VIEW: prm_monthlygameplaysessions_orgvise_view
-- Number of game sessions played per Month per Organization for the last 1 year
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `prm_monthlygameplaysessions_orgvise_view`;
create view prm_monthlygameplaysessions_orgvise_view as

SELECT
 mgpscvv.Organization as Organization,
 mgpscvv.Month as Month,
 mgpscvv.Year as Year,
 SUM(GameplaySessionsCount) AS `GameplaySessionsCount`

 FROM `prm_monthlygameplaysessions_childvise_view` mgpscvv  
 GROUP BY Organization, Month, Year
 ORDER BY Organization, Month, Year ASC;
 
-- ---------------------------------------------------------
--          VIEW: prm_attemptssummaryacrossgames_view
-- Competency level summary based on number of attempts. 
-- How many submissions took 1 (OR 2/3/4...) attempts across all questions, all game play sessions, all the games
-- Number of submissions Vs number of attempts (i.e X number of submissions that took Y attempts)
-- ---------------------------------------------------------- 
DROP view IF EXISTS `prm_attemptssummaryallgames_view`;
create view prm_attemptssummaryallgames_view as
SELECT
  attempts,
  COUNT(id_game_play_detail) AS `submissioncount`
  
FROM `game_play_detail_tbl`
GROUP BY attempts
ORDER BY attempts ASC;


-- ---------------------------------------------------------
--          VIEW: prm_totalsessiontimepergameplay_view
-- game play session length (sum of the time2answer values for all the questions/screens for a game play session)
-- ONLY the DATE part of the date_time_submission is taken as otherwise the 'GROUP BY' will treat each record separately as the date_time_submission will be different in the minutes or seconds
-- ------------------------------------------------------------

DROP view IF EXISTS `prm_totalsessiontimepergameplay_view`;
create view prm_totalsessiontimepergameplay_view as
SELECT 
       gpdt.id_game_play as id_game_play, 
       gpdt.id_child as childid,
       DATE(gpdt.date_time_submission) as date_played,
       SUM(gpdt.time2answer) as total_session_time
FROM game_play_detail_tbl gpdt
GROUP BY gpdt.id_game_play, childid, date_played
ORDER BY gpdt.id_child


-- ---------------------------------------------------------
--          VIEW: prm_dailytotalsessiontimeperchild_view
-- Total game play session time (across all games and all game play sessions) per day per child for the last ONE month 
-- (sum of the time2answer values for all the questions/screens for all game play sessions by a child per day for last one Month)
-- ------------------------------------------------------------
DROP view IF EXISTS `prm_dailytotalsessiontimeperchild_view`;
create view prm_dailytotalsessiontimeperchild_view as
SELECT tstpgpv.date_played as dateplayed,
       eauv.DeviceId as DeviceId,
       tstpgpv.childid as childid,
       eauv.Name as Name,
       eauv.Grade as Grade,
       eauv.Organization as Organization,
       SUM(tstpgpv.total_session_time) as 'Total_Gameplay_Session_Time'
FROM prm_totalsessiontimepergameplay_view tstpgpv, emrp_active_users_view eauv
WHERE (eauv.childid = tstpgpv.childid)  AND (DATE(tstpgpv.date_played) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW()) 
GROUP BY tstpgpv.date_played, tstpgpv.childid, DeviceId, Name, Grade, Organization
ORDER BY dateplayed, DeviceId, Name
       
-- ---------------------------------------------------------
--          VIEW: prm_avggameplaysessiontimeperchild_view
-- game play session length per child 
-- (sum of the time2answer values for all the questions/screens for all game play sessions by a child)
-- ------------------------------------------------------------

DROP view IF EXISTS `prm_avggameplaysessiontimeperchild_view`;
create view prm_avggameplaysessiontimeperchild_view as
SELECT tstpgpv.childid as childid,
       eauv.Name as Name,
       eauv.DeviceId as DeviceId,
       eauv.Grade as Grade,
       eauv.Organization as Organization,
       SUM(tstpgpv.total_session_time) as 'Total_Gameplay_Session_Time',
       COUNT(tstpgpv.id_game_play) as 'Number_Of_Gameplay_Sessions',
       ROUND(AVG(tstpgpv.total_session_time),0) as 'Avg_Gameplay_Session_Time',
       MAX(tstpgpv.date_played) as date_last_played
FROM prm_totalsessiontimepergameplay_view tstpgpv, emrp_active_users_view eauv
WHERE eauv.childid = tstpgpv.childid
GROUP BY tstpgpv.childid, Name, DeviceId, Grade 
ORDER BY Name


-- ---------------------------------------------------------
--          VIEW: prm_totalsessionspergame_view
-- Total number of game play session per game (which game is played highest)
-- ------------------------------------------------------------

DROP view IF EXISTS `prm_totalsessionspergame_view`;
create view prm_totalsessionspergame_view as
SELECT gpt.id_game as GameId,
       COUNT(gpt.id_game_play) as PlaySessions
FROM game_play_tbl gpt
GROUP BY gpt.id_game ORDER BY PlaySessions DESC
  
-- ----------------------------------------------------------
--     VIEW: prm_childtimepergameplaysession
--  Total time spent by a child on each game play session with dates they played 
--  (sum of 'time2answer' of all the questions/screens a child submitted within a game-play-session)
-- ----------------------------------------------------------


DROP view IF EXISTS `prm_childtimepergameplaysession_view`;
create view prm_childtimepergameplaysession_view as
SELECT 
       gpdt.id_child as childid,
       cht.child_name as Name,
       cht.deviceid as DeviceId,
       cht.organization as Organization,
       gpdt.id_game_play as id_game_play, 
       gpt.id_game as id_game,
       gpt.start_time as session_start_time,
       SUM(gpdt.time2answer) as total_session_time
FROM game_play_detail_tbl gpdt
       LEFT JOIN game_play_tbl gpt ON (gpt.id_game_play = gpdt.id_game_play)
       LEFT JOIN child_tbl cht ON (cht.id_child = gpdt.id_child) 
WHERE  (DATE(gpt.start_time) BETWEEN (NOW()-INTERVAL 2 WEEK) AND NOW()) 
GROUP BY gpdt.id_game_play, gpt.id_game, gpdt.id_child, Name, DeviceId, session_start_time
ORDER BY Name, session_start_time


-- ---------------------------------------------------------
--          VIEW: prm_questionsubmissionsandattemptscounts_view
-- List of Questions with their total #submissions and the number of submissions with #attempts 4 or more
-- The subsequent VIEW (prm_questionswithfourormoreattempts), which eliminated all the records with submissionswith4ormoreattempts=0 is what is used for Report 
-- ---------------------------------------------------------- 

DROP view IF EXISTS `prm_questionsubmissionsandattemptscounts_view`;
create view prm_questionsubmissionsandattemptscounts_view as
SELECT
  SUBSTRING_INDEX(gpdt.id_question,'#', 1) AS QuestionID,
  COUNT(gpdt.id_game_play_detail) AS totalsubmissions,
  COUNT(if(gpdt.attempts > 3,gpdt.id_game_play_detail,null)) AS submissionswith4ormoreattempts
FROM  game_play_detail_tbl gpdt
GROUP BY QuestionID 
ORDER BY submissionswith4ormoreattempts DESC


DROP view IF EXISTS `prm_questionswithfourormoreattempts_view`;
create view prm_questionswithfourormoreattempts_view as
SELECT
  QuestionID,
  totalsubmissions,
  submissionswith4ormoreattempts
FROM  prm_questionsubmissionsandattemptscounts_view 
WHERE submissionswith4ormoreattempts > 0
GROUP BY QuestionID 
ORDER BY submissionswith4ormoreattempts DESC

       

 -- ---------------------------------------------------------
--          VIEW: prm_weeklygameplaysessions_perdevice_view
-- Number of game sessions played per Week per Device for the last 6 months
--  (This view is used by the view emrp_activedevices_view to list all active devices (devices played in all weeks for last 4 weeks)
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `prm_weeklygameplaysessions_perdevice_view`;
create view prm_weeklygameplaysessions_perdevice_view as

SELECT
 child_tbl.deviceid as DeviceId,
 COUNT(DISTINCT game_play_tbl.id_child) as Users,
 WEEK(game_play_tbl.start_time) as Week,
 SUBDATE(DATE(game_play_tbl.start_time), dayofweek(DATE(game_play_tbl.start_time)) - 1) as WeekStartDate,
 YEAR(game_play_tbl.start_time) as  Year,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 WEEK) AND NOW(), id_game_play,0)) AS `GameplaySessionsWeeklyCount`
 
 FROM `child_tbl`, `game_play_tbl`  
 WHERE (child_tbl.id_child = game_play_tbl.id_child) AND (DATE(start_time) BETWEEN (NOW()-INTERVAL 24 WEEK) AND NOW())  
 GROUP BY DeviceId, Week, WeekStartDate, Year
 ORDER BY DeviceId, Week, WeekStartDate, Year ASC;


-- ---------------------------------------------------------
--          VIEW: prm_activedevices_view
-- Devices that have played every week during the last 4 weeks
-- This view is used for the report active devices (active devices at any point is those devices which has played all the 4 weeks during last 4 weeks)
-- ---------------------------------------------------------- 
DROP view IF EXISTS `prm_activedevices_view`;
create view prm_activedevices_view as

SELECT
 DeviceId,
 MAX(Users) as Users,
 MAX(IF(Week = WEEK(CURDATE() - INTERVAL 3 WEEK), GameplaySessionsWeeklyCount, 0))  Week1, 
 MAX(IF(Week = WEEK(CURDATE() - INTERVAL 2 WEEK), GameplaySessionsWeeklyCount, 0))  Week2, 
 MAX(IF(Week = WEEK(CURDATE() - INTERVAL 1 WEEK), GameplaySessionsWeeklyCount, 0)) Week3, 
 MAX(IF(Week = WEEK(CURDATE()), GameplaySessionsWeeklyCount, 0))  Week4, 
 SUM(GameplaySessionsWeeklyCount) as TotalSessionsCount
 
 FROM `prm_weeklygameplaysessions_perdevice_view`  
 WHERE (Week BETWEEN WEEK(CURDATE() - INTERVAL 3 WEEK) AND WEEK(CURDATE()))  
 GROUP BY DeviceId
 HAVING (COUNT(DeviceID) > 3)
 ORDER BY DeviceId;
 
 
 
 
 
 
 
 
 
-- -----------------------------------------------------
-- CHALLENGE MODE REPORTS TABLES
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `reports_chm_groups_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reports_chm_groups_tbl`;
CREATE TABLE IF NOT EXISTS `reports_chm_groups_tbl` (
  `report_group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL  default 1,
  PRIMARY KEY  (`report_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

-- -----------------------------------------------------
-- Table `reports_chm_tbl`
-- view_name: the view from which this report will fetch records
-- uniquevaluecolumnname: The column of the 'view' used for this report that will have unique values 
-- (as there is no 'primary key' for views, this column will be used to do counts of total records while fetching values for the datatable through ajax (used in server_processing class))
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reports_chm_tbl`;
CREATE TABLE IF NOT EXISTS `reports_chm_tbl` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_code` varchar(50) NOT NULL,
  `report_name` varchar(100) NOT NULL,
  `view_name` varchar(60) NOT NULL,
  `uniquevaluecolumnname` varchar(100) NOT NULL, 
  `report_description` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL COMMENT 'Id of the report group to which this report belongs to',
  `is_active` tinyint(1) NOT NULL default 1,
  `display_order` int(11) NOT NULL default '1',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `report_chm_columns_tbl`
-- report_column_name entry should be same as that in the associated view
-- -----------------------------------------------------
DROP TABLE IF EXISTS `report_chm_columns_tbl`;
CREATE TABLE IF NOT EXISTS `report_chm_columns_tbl` (
  `report_column_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `report_column_seqid` int(11) NOT NULL,
  `report_column_name` varchar(60) NOT NULL,
  `report_column_label` varchar(60) DEFAULT NULL COMMENT 'stores the column lable as it appears in the report header',
  `column_datatype` varchar(20) NOT NULL,
  PRIMARY KEY (`report_column_auto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;


-- -----------------------------------------------------
-- Table `report_chm_whereclause_tbl`
-- (For filters)
-- report_whereclause_column_name entry should be same as that in the associated view
-- -----------------------------------------------------
DROP TABLE IF EXISTS `report_chm_whereclause_tbl`;
CREATE TABLE IF NOT EXISTS `report_chm_whereclause_tbl` (
  `report_whereclause_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `report_whereclause_seqid` int(11) NOT NULL,
  `report_whereclause_column_name` varchar(60) NOT NULL,
  `report_whereclause_column_label` varchar(60) DEFAULT NULL COMMENT 'The column name as it appears in the UI',
  `wc_datatype` varchar(20) NOT NULL,
  `column_data_prefix` varchar(30) DEFAULT NULL,
  `default_value` varchar(50) default NULL COMMENT 'Default value for the whereclause field (the value entered here will be used as the default value, except if the value is  ''CURRENTDATE'' . For ''CURRENTDATE'', the actual date is shown as the default value)',
  PRIMARY KEY (`report_whereclause_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


-- -----------------------------------------------------
-- Table `report_chm_master_wc_tbl`
-- To store all the table keys and values so that reports whereclause values can be rendered on the screen wth drop down values for such FKs
--
-- Whenever the report_whereclause_tbl has a field with wc_coulm_name for a report, the report whereclause selection 
-- drop-down will show all the values in the table table_name in the column with fieldname support_column_name in the selection drop-down boxas possible values
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reports_chm_master_wc_tbl`;
CREATE TABLE IF NOT EXISTS `report_chm_master_wc_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(70) NOT NULL,
  `wc_column_name` varchar(70) NOT NULL,
  `support_column_name` varchar(70) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ---------------------------------------------------------
--          Table - charts_chm_tbl
-- is_dashboard - whether this chart is being displayed on the Dashboard
-- maxrecordstodisplay - The View may have more records (to be used for Reports) than required for Chart.
--                       Will fetch only last 'maxrecordstodisplay' to show in the Chart
-- maxrecordsfrom - pick 'maxrecrodstodisplay' starting from top or bottom ('top' or 'bottom')
-- orderby_columnname - This is the name of the column in the View which should be used to 'order by' to fetch last 'maxrecordstodisplay' number of records
-- ----------------------------------------------------------

DROP TABLE IF EXISTS `charts_chm_tbl`;
CREATE TABLE IF NOT EXISTS `charts_chm_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_name` varchar(256) NOT NULL,
  `chart_description` varchar(512) NOT NULL, 
  `view_name` varchar(256) NOT NULL,
  `maxrecordstodisplay` int(11) NOT NULL, 
  `maxrecordsfrom` varchar(100) NOT NULL,
  `orderby_columnname` varchar(100) NOT NULL,
  `is_dashboard` tinyint(1) NOT NULL default 1,
  `display_order` int(11) NOT NULL default '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------
--          CHALLENGE MODE REPORTS MASTER DATA
-- ----------------------------------------------------------

INSERT INTO `reports_chm_groups_tbl` (`report_group_id`, `group_name`, `display_order`) VALUES
(1, 'User Reports', 1),
(2, 'Engagement Reports', 2),

(4, 'App Usage Metrics Reports', 4);

INSERT INTO `reports_chm_tbl` (`report_id`, `report_code`, `report_name`, `view_name`, `uniquevaluecolumnname`, `report_description`, `group_id`, `is_active`, `display_order`) VALUES
(1, 'USRRPT1', 'Registered Users', 'emrp_active_users_view', 'childid', 'Details of all the registered Children',1,1,1),
(2, 'USRRPT2', 'Daily Registration Stats', 'emrp_dailyregistration_view','RegDate', 'Daily Registration Statistics',1,1,2),
(3, 'USRRPT3', 'Weekly Registration Stats', 'emrp_weeklyregistration_view','RegWeek', 'Weekly Registration Statistics',1,1,3),
(4, 'USRRPT4', 'Monthly Registration Stats', 'emrp_monthlyregistration_view','RegMonth', 'Monthly Registration Statistics',1,1,4),
(5, 'ENGRPT1', 'Daily Game Play Session Stats', 'chmm_dailygameplaysessions_view','SessionDate', 'Daily Game Play Session Statistics',2,1,1),

(7, 'AUMRPT1', 'Avg. Play Session Time', 'chm_avggameplaysessiontimeperchild_view','childid', 'Average session time across all game play sessions played by a Child ',4,1,2),
(8, 'AUMRPT2', 'Game Utilization Metrics', 'chm_totalsessionspergame_view','GameId','Total number of play sessions for each of the Games',4,1,3),
(9, 'AUMRPT3', 'Game Play Sessions (Last 2 Wks)', 'chm_childtimepergameplaysession_view', 'id_game_play', 'Game Play Sessions played by each Child during the last two weeks',4,1,4),
(10, 'USRRPT5', 'Monthly Registration Stats by Organization', 'chm_monthlyregistration_orgvise_view','Organization', 'Organization-vise Registration Stats',1,1,5),
(11, 'ENGRPT2', 'Monthly Game Play Session Stats', 'chm_monthlygameplaysessions_view','Month', 'Monthly Game Play Session Statistics',2,1,2),
(12, 'ENGRPT3', 'Monthly Game Play Session Stats Child-vise', 'chm_monthlygameplaysessions_childvise_view','Month', 'Monthly Game Play Session Statistics per Child',2,1,3),
(13, 'ENGRPT4', 'Monthly Game Play Session Stats Organization-vise', 'chm_monthlygameplaysessions_orgvise_view','Month', 'Monthly Game Play Session Statistics per Organization',2,1,4),

(15, 'AUMRPT4', 'Daily Total Game Play Session time per Child', 'chm_dailytotalsessiontimeperchild_view','dateplayed', 'Total Game Play Session time per Child per Day for the last one Month',4,1,1),
(16, 'USRRPT6', 'Active Devices','chm_activedevices_view','DeviceId','List of Devices logged-in at least once every week during the last 4 weeks',1,1,6),
(17, 'ENGRPT6', 'Weekly Game Play Sessions Device-vise', 'chm_weeklygameplaysessions_perdevice_view','DeviceId', 'Total Game Play Sessions count per Device per Week during the last 6 months',2,1,6);




-- report_column_name entry should be same as that in the associated view
INSERT INTO `report_chm_columns_tbl` (`report_id`, `report_column_seqid`, `report_column_name`, `report_column_label`, `column_datatype`) VALUES
(1, 1, 'Name', 'Name', 'varchar'),
(1, 2, 'DeviceId', 'DeviceId', 'varchar'),
(1, 3, 'Grade', 'Grade', 'varchar'),
(1, 4, 'Language', 'Language', 'varchar'),
(1, 5, 'SchoolType', 'School Type', 'varchar'),
(1, 6, 'Organization', 'Organization', 'varchar'),
(1, 7, 'District', 'District', 'varchar'),
(1, 8, 'Created_Datetime', 'Date', 'datetime'),

(2, 1, 'RegDate', 'Date', 'datetime'),
(2, 2, 'RegistrationCount', '#Registrations', 'integer'),

(3, 1, 'RegWeek', 'Week', 'varchar'),
(3, 2, 'RegistrationCount', '#Registrations', 'integer'),

(4, 1, 'RegMonth', 'Month', 'varchar'),
(4, 2, 'RegistrationCount', '#Registrations', 'integer'),

(5, 1, 'SessionDate','Date','datetime'),
(5, 2, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(7, 1, 'Name','Name','varchar'),
(7, 2, 'DeviceId','DeviceId','varchar'),
(7, 3, 'Grade','Grade','varchar'),
(7, 4, 'Organization','Organization','varchar'),
(7, 5, 'Total_Gameplay_Session_Time','Total Session Time','integer'),
(7, 6, 'Number_Of_Gameplay_Sessions','Number of Sessions','integer'),
(7, 7, 'Avg_Gameplay_Session_Time','Avg Session Time','integer'),
(7, 8, 'date_last_played','Last Played On','datetime'),

(8, 1, 'GameId','GameId','varchar'),
(8, 2, 'PlaySessions','Play Sessions','integer'),


(9, 1, 'Name','Name','varchar'),
(9, 2, 'DeviceId','DeviceId','varchar'),
(9, 3, 'Organization','Organization','varchar'),
(9, 4, 'id_game','GameId','varchar'),
(9, 5, 'session_start_time','Session Date','datetime'),
(9, 6, 'total_session_time','Total Session Time','integer'),

(10, 1, 'Organization', 'Organization', 'varchar'),
(10, 2, 'RegMonth', 'Month', 'varchar'),
(10, 3, 'RegYear', 'Year', 'varchar'),
(10, 4, 'RegistrationCount', '#Registrations', 'integer'),

(11, 1, 'Month','Month','integer'),
(11, 2, 'Year','Year','integer'),
(11, 3, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(12, 1, 'Name','Name','varchar'),
(12, 2, 'DeviceId','DeviceId','varchar'),
(12, 3, 'Organization','Organization','varchar'),
(12, 4, 'Month','Month','integer'),
(12, 5, 'Year','Year','integer'),
(12, 6, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(13, 1, 'Organization','Organization','varchar'),
(13, 2, 'Month','Month','integer'),
(13, 3, 'Year','Year','integer'),
(13, 4, 'GameplaySessionsCount','Gameplay Sessions','integer'),

(15, 1, 'dateplayed','Date','datetime'),
(15, 2, 'DeviceId','DeviceId','varchar'),
(15, 3, 'Name','Name','varchar'),
(15, 4, 'Grade','Grade','varchar'),
(15, 5, 'Organization','Organization','varchar'),
(15, 6, 'Total_Gameplay_Session_Time','Total Session Time','integer'),

(16, 1, 'DeviceId','DeviceId','varchar'),
(16, 2, 'Users','Users','integer'),
(16, 3, 'Week1','Wk1Sessions','integer'),
(16, 4, 'Week2','Wk2Sessions','integer'),
(16, 5, 'Week3','Wk3Sessions','integer'),
(16, 6, 'Week4','Wk4Sessions','integer'),
(16, 7, 'TotalSessionsCount','Total Sessions Count','integer'),

(17, 1, 'DeviceId','DeviceId','varchar'),
(17, 2, 'Users','Users','integer'),
(17, 3, 'Week','Week','integer'),
(17, 4, 'Year','Year','integer'),
(17, 5, 'WeekStartDate','Week Start Date','datetime'),
(17, 6, 'GameplaySessionsWeeklyCount','Weekly Sessions Count','integer');



-- report_whereclause_column_name entry should be same as that in the associated view
INSERT INTO `report_chm_whereclause_tbl` (`report_id`, `report_whereclause_seqid`, `report_whereclause_column_name`, `report_whereclause_column_label`, `wc_datatype`, `column_data_prefix`, `default_value`) VALUES
(1, 1, 'Grade', 'Grade', 'varchar', NULL, NULL),
(1, 2, 'Language', 'Language', 'varchar', NULL, NULL),
(1, 3, 'Created_Datetime', 'Reg. Date', 'datetime', NULL, NULL),
(1, 4, 'Organization', 'Organization', 'varchar', NULL, NULL),
(1, 5, 'District', 'District', 'varchar', NULL, NULL),
(2, 1, 'RegDate','Registration Date','datetime',NULL,NULL),
(5, 1, 'SessionDate','Session Date','datetime',NULL,NULL),

(7, 1, 'Grade','Grade','varchar',NULL,NULL),
(7, 2, 'Organization','Organization','varchar',NULL,NULL),
(7, 3, 'Number_Of_Gameplay_Sessions','Number of Sessions','integer',NULL,NULL),
(7, 4, 'date_last_played','Last Played On','datetime',NULL,NULL),
(8, 1, 'GameId','GameId','varchar',NULL,NULL),
(9, 1, 'Name','Name','varchar',NULL,NULL),
(9, 2, 'DeviceId','DeviceId','varchar',NULL,NULL),
(9, 3, 'Organization','Organization','varchar',NULL,NULL),
(9, 4, 'id_game','GameId','varchar',NULL,NULL),
(9, 5, 'session_start_time','Session Date','datetime',NULL,NULL),
(9, 6, 'total_session_time','Total Session Time','integer',NULL,NULL),
(10, 1, 'Organization', 'Organization', 'varchar', NULL, NULL),
(12, 1, 'Organization', 'Organization', 'varchar', NULL, NULL),
(13, 1, 'Organization', 'Organization', 'varchar', NULL, NULL),

(15, 1, 'Name','Name','varchar',NULL,NULL),
(15, 2, 'DeviceId','DeviceId','varchar',NULL,NULL),
(15, 3, 'Grade','Grade','varchar',NULL,NULL),
(15, 4, 'Organization','Organization','varchar',NULL,NULL),
(15, 5, 'dateplayed','Date','datetime',NULL,NULL),
(17, 1, 'WeekStartDate','Week Start Date','datetime',NULL,NULL);

-- If the report_chm_whereclause_tbl has an entry equal to wc_column_name, read all the values in the support_column_name in the table (specified by the table_name) and present in the drop-down selection box
INSERT INTO `report_chm_master_wc_tbl` (`id`, `table_name`, `wc_column_name`, `support_column_name`) VALUES
(1, 'grade_tbl', 'Grade', 'description'),
(2, 'language_tbl', 'Language', 'description');

-- ---------------------------------------------------------
--         CHALLENGE MODE CHARTS MASTER DATA
------------------------------------------------------------

INSERT INTO `charts_chm_tbl` (`chart_name`, `chart_description`,`view_name`,`maxrecordstodisplay`,`maxrecordsfrom`,`orderby_columnname`,`is_dashboard`,`display_order`) VALUES
('Game utilization', 'Total number of play sessions for various Games','chm_totalsessionspergame_view',40,'top','PlaySessions', 0,1),
('Weekly Registration Stats', 'Registrations per week for the last 12 weeks','emrp_weeklyregistration_view',12,'bottom','RegWeek', 1,2),
('Daily Game Play Sessions', 'Game Play Sessions per day for the last 30 days','chm_dailygameplaysessions_view',15,'bottom','SessionDate',1,3),
('Govt-Pvt School Distribution', 'Govt vs Pvt Schooltype Child Distribution','emrp_schooltypewisechildcount_view',2,'top','schooltypeid',1,5);




-- ---------------------------------------------------------
--          CHALLENGE MODE REPORTS VIEWS
-- ----------------------------------------------------------



-- ---------------------------------------------------------
--          VIEW: chm_dailygameplaysessions_view
-- Number of game sessions played per day for the last 1 year
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `chm_dailygameplaysessions_view`;
create view chm_dailygameplaysessions_view as

SELECT
 DATE(start_time) as SessionDate,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 DAY) AND NOW(), id_game_play,0)) AS `GameplaySessionsCount`

 FROM `chm_game_play_tbl`  
 WHERE (DATE(start_time) BETWEEN (NOW()-INTERVAL 365 DAY) AND NOW()) 
 GROUP BY SessionDate
 ORDER BY SessionDate ASC;
 
-- ---------------------------------------------------------
--          VIEW: chm_monthlygameplaysessions_view
-- Number of game sessions played per Month for the last 1 year
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `chm_monthlygameplaysessions_view`;
create view chm_monthlygameplaysessions_view as

SELECT
 MONTH(start_time) as Month,
 YEAR(start_time) as  Year,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW(), id_game_play,0)) AS `GameplaySessionsCount`

 FROM `chm_game_play_tbl`  
 WHERE (DATE(start_time) BETWEEN (NOW()-INTERVAL 12 MONTH) AND NOW()) 
 GROUP BY Month, Year
 ORDER BY Month, Year ASC;
 
 -- ---------------------------------------------------------
--          VIEW: chm_monthlygameplaysessions_childvise_view
-- Number of game sessions played per Month per Child for the last 1 year
-- (This view is used for creating emrp_chart_monthlygameplaysessions_orgvise_view
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `chm_monthlygameplaysessions_childvise_view`;
create view chm_monthlygameplaysessions_childvise_view as

SELECT
 child_tbl.id_child as id_child,
 child_tbl.child_name as Name,
 child_tbl.deviceid as DeviceId,
 child_tbl.organization as Organization,
 MONTH(chm_game_play_tbl.start_time) as Month,
 YEAR(chm_game_play_tbl.start_time) as  Year,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW(), id_game_play,0)) AS `GameplaySessionsCount`

 FROM `child_tbl`, `chm_game_play_tbl`  
 WHERE (child_tbl.id_child = chm_game_play_tbl.id_child) AND (DATE(start_time) BETWEEN (NOW()-INTERVAL 12 MONTH) AND NOW()) 
 GROUP BY id_child, Name, Month, Year
 ORDER BY id_child, Name, Month, Year ASC;
 
 -- ---------------------------------------------------------
--          VIEW: chm_monthlygameplaysessions_orgvise_view
-- Number of game sessions played per Month per Organization for the last 1 year
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `chm_monthlygameplaysessions_orgvise_view`;
create view chm_monthlygameplaysessions_orgvise_view as

SELECT
 mgpscvv.Organization as Organization,
 mgpscvv.Month as Month,
 mgpscvv.Year as Year,
 SUM(GameplaySessionsCount) AS `GameplaySessionsCount`

 FROM `chm_monthlygameplaysessions_childvise_view` mgpscvv  
 GROUP BY Organization, Month, Year
 ORDER BY Organization, Month, Year ASC;
 

-- ---------------------------------------------------------
--          VIEW: chm_totalsessiontimepergameplay_view
-- game play session length (sum of the time2answer values for all the questions/screens for a game play session)
-- ONLY the DATE part of the date_time_submission is taken as otherwise the 'GROUP BY' will treat each record separately as the date_time_submission will be different in the minutes or seconds
-- ------------------------------------------------------------

DROP view IF EXISTS `chm_totalsessiontimepergameplay_view`;
create view chm_totalsessiontimepergameplay_view as
SELECT 
       gpdt.id_game_play as id_game_play, 
       gpdt.id_child as childid,
       DATE(gpdt.date_time_submission) as date_played,
       SUM(gpdt.time2answer) as total_session_time
FROM chm_game_play_detail_tbl gpdt
GROUP BY gpdt.id_game_play, childid, date_played
ORDER BY gpdt.id_child


-- ---------------------------------------------------------
--          VIEW: chm_dailytotalsessiontimeperchild_view
-- Total game play session time (across all games and all game play sessions) per day per child for the last ONE month 
-- (sum of the time2answer values for all the questions/screens for all game play sessions by a child per day for last one Month)
-- ------------------------------------------------------------
DROP view IF EXISTS `chm_dailytotalsessiontimeperchild_view`;
create view chm_dailytotalsessiontimeperchild_view as
SELECT tstpgpv.date_played as dateplayed,
       eauv.DeviceId as DeviceId,
       tstpgpv.childid as childid,
       eauv.Name as Name,
       eauv.Grade as Grade,
       eauv.Organization as Organization,
       SUM(tstpgpv.total_session_time) as 'Total_Gameplay_Session_Time'
FROM chm_totalsessiontimepergameplay_view tstpgpv, emrp_active_users_view eauv
WHERE (eauv.childid = tstpgpv.childid)  AND (DATE(tstpgpv.date_played) BETWEEN (NOW()-INTERVAL 1 MONTH) AND NOW()) 
GROUP BY tstpgpv.date_played, tstpgpv.childid, DeviceId, Name, Grade, Organization
ORDER BY dateplayed, DeviceId, Name
       
-- ---------------------------------------------------------
--          VIEW: chm_avggameplaysessiontimeperchild_view
-- game play session length per child 
-- (sum of the time2answer values for all the questions/screens for all game play sessions by a child)
-- ------------------------------------------------------------

DROP view IF EXISTS `chm_avggameplaysessiontimeperchild_view`;
create view chm_avggameplaysessiontimeperchild_view as
SELECT tstpgpv.childid as childid,
       eauv.Name as Name,
       eauv.DeviceId as DeviceId,
       eauv.Grade as Grade,
       eauv.Organization as Organization,
       SUM(tstpgpv.total_session_time) as 'Total_Gameplay_Session_Time',
       COUNT(tstpgpv.id_game_play) as 'Number_Of_Gameplay_Sessions',
       ROUND(AVG(tstpgpv.total_session_time),0) as 'Avg_Gameplay_Session_Time',
       MAX(tstpgpv.date_played) as date_last_played
FROM chm_totalsessiontimepergameplay_view tstpgpv, emrp_active_users_view eauv
WHERE eauv.childid = tstpgpv.childid
GROUP BY tstpgpv.childid, Name, DeviceId, Grade 
ORDER BY Name


-- ---------------------------------------------------------
--          VIEW: chm_totalsessionspergame_view
-- Total number of game play session per game (which game is played highest)
-- ------------------------------------------------------------

DROP view IF EXISTS `chm_totalsessionspergame_view`;
create view chm_totalsessionspergame_view as
SELECT gpt.id_game as GameId,
       COUNT(gpt.id_game_play) as PlaySessions
FROM chm_game_play_tbl gpt
GROUP BY gpt.id_game ORDER BY PlaySessions DESC
  
-- ----------------------------------------------------------
--     VIEW: chm_childtimepergameplaysession
--  Total time spent by a child on each game play session with dates they played 
--  (sum of 'time2answer' of all the questions/screens a child submitted within a game-play-session)
-- ----------------------------------------------------------


DROP view IF EXISTS `chm_childtimepergameplaysession_view`;
create view chm_childtimepergameplaysession_view as
SELECT 
       gpdt.id_child as childid,
       cht.child_name as Name,
       cht.deviceid as DeviceId,
       cht.organization as Organization,
       gpdt.id_game_play as id_game_play, 
       gpt.id_game as id_game,
       gpt.start_time as session_start_time,
       SUM(gpdt.time2answer) as total_session_time
FROM chm_game_play_detail_tbl gpdt
       LEFT JOIN chm_game_play_tbl gpt ON (gpt.id_game_play = gpdt.id_game_play)
       LEFT JOIN child_tbl cht ON (cht.id_child = gpdt.id_child) 
WHERE  (DATE(gpt.start_time) BETWEEN (NOW()-INTERVAL 2 WEEK) AND NOW()) 
GROUP BY gpdt.id_game_play, gpt.id_game, gpdt.id_child, Name, DeviceId, session_start_time
ORDER BY Name, session_start_time

     

-- ---------------------------------------------------------
--          VIEW: chm_weeklygameplaysessions_perdevice_view
-- Number of game sessions played per Week per Device for the last 6 months
--  (This view is used by the view emrp_activedevices_view to list all active devices (devices played in all weeks for last 4 weeks)
-- ---------------------------------------------------------- 
 
DROP view IF EXISTS `chm_weeklygameplaysessions_perdevice_view`;
create view chm_weeklygameplaysessions_perdevice_view as

SELECT
 child_tbl.deviceid as DeviceId,
 COUNT(DISTINCT chm_game_play_tbl.id_child) as Users,
 WEEK(chm_game_play_tbl.start_time) as Week,
 SUBDATE(DATE(chm_game_play_tbl.start_time), dayofweek(DATE(chm_game_play_tbl.start_time)) - 1) as WeekStartDate,
 YEAR(chm_game_play_tbl.start_time) as  Year,
 COUNT(if (DATE(start_time) BETWEEN (NOW()-INTERVAL 1 WEEK) AND NOW(), id_game_play,0)) AS `GameplaySessionsWeeklyCount`
 
 FROM `child_tbl`, `chm_game_play_tbl`  
 WHERE (child_tbl.id_child = chm_game_play_tbl.id_child) AND (DATE(start_time) BETWEEN (NOW()-INTERVAL 24 WEEK) AND NOW())  
 GROUP BY DeviceId, Week, WeekStartDate, Year
 ORDER BY DeviceId, Week, WeekStartDate, Year ASC;


-- ---------------------------------------------------------
--          VIEW: chm_activedevices_view
-- Devices that have played every week during the last 4 weeks
-- This view is used for the report active devices (active devices at any point is those devices which has played all the 4 weeks during last 4 weeks)
-- ---------------------------------------------------------- 
DROP view IF EXISTS `chm_activedevices_view`;
create view chm_activedevices_view as

SELECT
 DeviceId,
 MAX(Users) as Users,
 MAX(IF(Week = WEEK(CURDATE() - INTERVAL 3 WEEK), GameplaySessionsWeeklyCount, 0))  Week1, 
 MAX(IF(Week = WEEK(CURDATE() - INTERVAL 2 WEEK), GameplaySessionsWeeklyCount, 0))  Week2, 
 MAX(IF(Week = WEEK(CURDATE() - INTERVAL 1 WEEK), GameplaySessionsWeeklyCount, 0)) Week3, 
 MAX(IF(Week = WEEK(CURDATE()), GameplaySessionsWeeklyCount, 0))  Week4, 
 SUM(GameplaySessionsWeeklyCount) as TotalSessionsCount
 
 FROM `chm_weeklygameplaysessions_perdevice_view`  
 WHERE (Week BETWEEN WEEK(CURDATE() - INTERVAL 3 WEEK) AND WEEK(CURDATE()))  
 GROUP BY DeviceId
 HAVING (COUNT(DeviceID) > 3)
 ORDER BY DeviceId;
 
 
 