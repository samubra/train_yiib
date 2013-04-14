-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 14 日 11:33
-- 服务器版本: 5.5.29
-- PHP 版本: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `train`
--

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '元数据ID',
  `uid` int(10) unsigned DEFAULT NULL COMMENT '所属用户',
  `parent` int(10) unsigned DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '名称',
  `slug` varchar(200) DEFAULT NULL COMMENT '缩略',
  `type` varchar(32) DEFAULT NULL COMMENT '元数据所属类型',
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类数据标' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '学员ID',
  `name` varchar(20) NOT NULL COMMENT '学员姓名',
  `cnum` int(18) NOT NULL COMMENT '身份证号码',
  `mphome` int(11) DEFAULT NULL COMMENT '移动电话',
  `fphone` int(11) DEFAULT NULL COMMENT '固定电话',
  `gender` enum('1','0') DEFAULT '1' COMMENT '性别',
  `marital` enum('0','1') DEFAULT '0' COMMENT '婚姻状况',
  `edu` varchar(10) DEFAULT NULL COMMENT '文化程度',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `politics` varchar(10) DEFAULT NULL COMMENT '政治面貌',
  `address` varchar(250) DEFAULT NULL COMMENT '家庭住址',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnum` (`cnum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学员表，每个学员都应该具有的基本信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `operation_member`
--

CREATE TABLE IF NOT EXISTS `operation_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) unsigned NOT NULL COMMENT '学员ID',
  `class_id` int(11) unsigned DEFAULT NULL COMMENT '班级ID',
  `class_num` varchar(10) DEFAULT NULL COMMENT '班级内序号',
  `isnew` enum('1','0') DEFAULT '1' COMMENT '是否新训，默认为1:新训',
  `health` varchar(200) DEFAULT NULL COMMENT '健康状况',
  `professional_title` varchar(200) DEFAULT NULL COMMENT '专业技术职称',
  `post` varchar(200) DEFAULT NULL COMMENT '职位',
  `unit_name` varchar(200) DEFAULT NULL COMMENT '单位名称',
  `operation_type` int(11) DEFAULT NULL COMMENT '操作类别',
  `certificate_num` varchar(19) DEFAULT NULL COMMENT '证书编号',
  `certificate_type` int(11) unsigned DEFAULT NULL COMMENT '证书类型',
  `issue_date` date DEFAULT NULL COMMENT '发证日期',
  `theory_score` varchar(5) DEFAULT NULL COMMENT '理论成绩',
  `operating_score` varchar(5) DEFAULT NULL COMMENT '实际操作成绩',
  `status` int(2) DEFAULT NULL COMMENT '状态',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `modified` int(10) unsigned DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `class_num` (`class_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='特种作业学员表`' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `term`
--

CREATE TABLE IF NOT EXISTS `term` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) DEFAULT NULL COMMENT '班级名称',
  `classcode` varchar(20) DEFAULT NULL COMMENT '班级代码',
  `start` date DEFAULT NULL COMMENT '开班日期',
  `end` date DEFAULT NULL COMMENT '结束日期',
  `count` int(5) DEFAULT '0' COMMENT '班级人数',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='班级表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `password_strategy` varchar(50) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `requires_new_password` tinyint(1) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `login_attempts` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `login_ip` varchar(32) DEFAULT NULL,
  `activation_key` varchar(128) DEFAULT NULL,
  `validation_key` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `level` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户级别',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `status`, `password`, `password_strategy`, `salt`, `requires_new_password`, `reset_token`, `login_attempts`, `login_time`, `login_ip`, `activation_key`, `validation_key`, `create_time`, `update_time`, `level`) VALUES
(1, 'admin', 'samubrapeng@gmail.com', 1, 'b2a7baaecfe639123e1ce88e33f0812fae13d3f1', 'ahash', '3b01b1f636ecffb66b1b23ad03f05e9e0aa475ad', NULL, NULL, NULL, 10, '127.0.0.1', NULL, '965f29102c300d814628dd978954cd6e', '2012-11-18 14:26:59', '2013-04-13 14:34:42', 9);

-- --------------------------------------------------------

--
-- 表的结构 `venture_company`
--

CREATE TABLE IF NOT EXISTS `venture_company` (
  `id` int(11) unsigned NOT NULL COMMENT '主键',
  `legal_person` int(11) unsigned NOT NULL COMMENT '法人ID，对应venture_member中的ID',
  `licensecode` int(15) unsigned DEFAULT NULL COMMENT '营业执照号码',
  `companyname` varchar(250) DEFAULT NULL COMMENT '企业名称',
  `companyaddress` varchar(250) DEFAULT NULL COMMENT '经营地址',
  `employ` int(2) DEFAULT '0' COMMENT '雇员人数',
  `sales` int(6) unsigned DEFAULT '0' COMMENT '月营业收入',
  `industry` int(11) unsigned DEFAULT NULL COMMENT '所属行业',
  `businesstype` int(1) DEFAULT NULL COMMENT '企业所属类型',
  `policestation` varchar(200) DEFAULT NULL COMMENT '注册工商所别',
  `subsidy` varchar(10) DEFAULT NULL COMMENT '国家资助金额',
  `start` date NOT NULL COMMENT '企业创办时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `licensecode` (`licensecode`),
  KEY `legal_person` (`legal_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='企业表';

-- --------------------------------------------------------

--
-- 表的结构 `venture_member`
--

CREATE TABLE IF NOT EXISTS `venture_member` (
  `id` int(11) unsigned NOT NULL COMMENT '创业培训学员资料，主键ID',
  `uid` int(11) unsigned NOT NULL COMMENT '对应member表ID，用户ID',
  `class_id` int(11) unsigned DEFAULT NULL COMMENT '所属班级ID',
  `class_num` varchar(2) DEFAULT NULL COMMENT '在班级中的序号，01至40',
  `penson_type` int(11) unsigned DEFAULT NULL COMMENT '人员类别',
  `gradunm` varchar(20) DEFAULT NULL COMMENT '结业证书号码',
  `status` int(2) DEFAULT NULL COMMENT '学员状态',
  `remark` varchar(200) DEFAULT NULL COMMENT '简短的备注说明',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `modified` int(10) unsigned DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `class_num` (`class_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='创业培训学员资料表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
