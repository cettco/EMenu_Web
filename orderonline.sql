-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 21 日 13:24
-- 服务器版本: 5.5.31
-- PHP 版本: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `orderonline`
--

-- --------------------------------------------------------

--
-- 表的结构 `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `question` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '问题',
  `answer` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '答案',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '状态',
  `restaurant_id` int(11) NOT NULL COMMENT '餐厅id',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `account`
--

INSERT INTO `account` (`account_id`, `username`, `password`, `email`, `question`, `answer`, `status`, `restaurant_id`) VALUES
(1, 'xiaoduoyi', '123', 'xiaoduoyi@163.com', '位置？', '同济大学嘉定校区', 'Normal', 1),
(2, 'maidanglao', '123', 'maidangluo@163.com', '类型？', '快餐', 'Normal', 2),
(3, 'x', '0', '0', '0', '0', 'Normal', 3),
(4, 'ysr', '123', 'ysr@163.com', '年纪', '22', 'Normal', 4),
(8, 'ysrysr', '123', 'ysr103109@163.com', '小学老师名字', '12asd', 'Normal', 16),
(9, 'lala', '123', 'sadfsaf', '小学老师名字', 'gasg', 'Normal', 17),
(10, 'adfaf', '123', 'eefasefs', '小学老师名字', 'faf', 'Normal', 18),
(11, 'adfafss', '123', 'eefasefs', '小学老师名字', 'faf', 'Normal', 19);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜品类id',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '菜品类名',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `menu_id` int(11) NOT NULL COMMENT '菜单id',
  PRIMARY KEY (`category_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `menu_id`) VALUES
(1, '酒水', '啦啦啦3232', 1),
(2, '盖饭', '啊啊啊', 1),
(4, '烧烤', '好吃的烧烤', 1);

-- --------------------------------------------------------

--
-- 表的结构 `hurry`
--

CREATE TABLE IF NOT EXISTS `hurry` (
  `hurry_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '催单id',
  `time` datetime NOT NULL COMMENT '时间',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `newhurry` int(11) NOT NULL COMMENT '新的催单',
  PRIMARY KEY (`hurry_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hurry`
--

INSERT INTO `hurry` (`hurry_id`, `time`, `order_id`, `newhurry`) VALUES
(1, '2014-05-19 18:10:45', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜目id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '菜目名',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '单位',
  `price` decimal(5,2) NOT NULL COMMENT '单价',
  `category_id` int(11) NOT NULL COMMENT '菜品类id',
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`item_id`, `name`, `description`, `unit`, `price`, `category_id`) VALUES
(1, 'a', 'aaaa                                                                                                        ', '碗', 6.50, 1),
(2, '宫保鸡丁', '123123', '盘', 15.00, 1),
(10, '青椒肉丝', '  撒的发顺丰                                                  ', '碗', 414.00, 2),
(11, '大盘鸡', '很厉害的鸡！', '盘', 52.00, 1),
(12, '刀削面', '面面面面面', '碗', 12.00, 1),
(13, '农家小炒肉', '张总最爱', '份', 10.00, 1),
(14, '米浆粿', '很好吃！', '块', 2.00, 1);

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `last_modified` datetime NOT NULL COMMENT '修改时间',
  `restaurant_id` int(11) NOT NULL COMMENT '餐厅id',
  PRIMARY KEY (`menu_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`menu_id`, `last_modified`, `restaurant_id`) VALUES
(1, '2014-04-27 00:00:00', 1),
(2, '2014-04-27 00:00:00', 2),
(3, '2014-04-27 13:31:14', 3),
(4, '2014-04-27 13:36:56', 4),
(5, '2014-05-21 12:16:12', 16),
(6, '2014-05-21 12:37:04', 17),
(7, '2014-05-21 12:41:48', 18),
(8, '2014-05-21 12:42:33', 19);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '餐桌id',
  `order_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '餐桌状态',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '上次更新时间',
  `bill` decimal(10,2) NOT NULL COMMENT '总价',
  `table_id` int(11) NOT NULL COMMENT '餐桌id',
  `restaurant_id` int(11) NOT NULL COMMENT '餐厅id',
  PRIMARY KEY (`order_id`),
  KEY `restaurant_id` (`restaurant_id`),
  KEY `table_id` (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`order_id`, `order_status`, `last_updated`, `bill`, `table_id`, `restaurant_id`) VALUES
(1, 'finished', '2014-05-20 05:05:47', 50.00, 1, 1),
(5, 'ordering', '2014-05-20 15:13:26', 0.00, 2, 1),
(9, 'finished', '2014-05-20 13:08:22', 0.00, 3, 1),
(11, 'finished', '2014-05-21 03:55:56', 2171.99, 1, 1),
(12, 'confirmed', '2014-05-20 12:51:32', 828.00, 1, 1),
(13, 'finished', '2014-05-20 13:05:08', 6390.00, 1, 1),
(14, 'pending', '2014-05-20 14:48:08', 271.00, 1, 1),
(15, 'pending', '2014-05-20 15:00:13', 105.00, 1, 1),
(16, 'pending', '2014-05-20 15:06:43', 315.00, 1, 1),
(17, 'pending', '2014-05-20 15:08:51', 165.00, 1, 1),
(18, 'pending', '2014-05-21 04:05:05', 8713.00, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
  `orderitem_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `quantity` int(11) NOT NULL COMMENT '数量',
  `item_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '状态',
  `item_id` int(11) NOT NULL COMMENT '菜目id',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  PRIMARY KEY (`orderitem_id`),
  KEY `item_id` (`item_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `orderitem`
--

INSERT INTO `orderitem` (`orderitem_id`, `quantity`, `item_status`, `item_id`, `order_id`) VALUES
(5, 13, 'served', 1, 1),
(16, 7, 'cooking', 2, 1),
(17, 17, 'cooking', 1, 11),
(18, 19, 'cooking', 2, 11),
(21, 4, 'cooking', 10, 11),
(22, 2, 'served', 10, 12),
(23, 16, 'served', 10, 13),
(24, 12, 'cooking', 2, 13),
(25, 12, 'cooking', 2, 14),
(26, 15, 'cooking', 1, 14),
(28, 6, 'cooking', 2, 15),
(29, 25, 'cooking', 2, 16),
(30, 11, 'cooking', 2, 17),
(31, 31, 'cooking', 2, 18),
(32, 23, 'cooking', 1, 18),
(33, 32, 'cooking', 11, 18),
(34, 29, 'cooking', 12, 18),
(35, 20, 'cooking', 10, 18);

-- --------------------------------------------------------

--
-- 表的结构 `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图片id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '图片名',
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `restaurant_id` int(11) DEFAULT NULL COMMENT '餐厅名',
  `item_id` int(11) DEFAULT NULL COMMENT '菜目id',
  PRIMARY KEY (`picture_id`),
  KEY `item_id` (`item_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `picture`
--

INSERT INTO `picture` (`picture_id`, `name`, `description`, `restaurant_id`, `item_id`) VALUES
(1, '1400586436.jpg', 'aaaa                                                                                                        ', 1, 1),
(2, 'mdl.jpeg', '阿什顿发对方水电费', 2, NULL),
(3, 'a.jpeg', 'Description', 1, 2),
(7, '1400574134.jpg', '  撒的发顺丰                                                  ', NULL, 10),
(8, '1400647020', '哈哈哈', 17, NULL),
(9, '1400647308.jpg', '哈哈哈', 18, NULL),
(10, '1400647353.jpg', '哈哈哈', 19, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `qrcode`
--

CREATE TABLE IF NOT EXISTS `qrcode` (
  `qrcode_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '二维码id',
  `qrcode_data` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '二维码数据',
  `table_id` int(11) NOT NULL COMMENT '餐桌id',
  `restaurant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`qrcode_id`),
  KEY `table_id` (`table_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `qrcode`
--

INSERT INTO `qrcode` (`qrcode_id`, `qrcode_data`, `table_id`, `restaurant_id`) VALUES
(1, '1-1', 1, 1),
(2, '1-2', 2, 1),
(3, '1-3', 3, 1),
(4, '1-4', 4, 1),
(5, '1-5', 5, 1),
(7, '1-6', 0, 1),
(8, '1-7', 0, 1),
(9, '1-8', 8, 1);

-- --------------------------------------------------------

--
-- 表的结构 `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '餐厅id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '餐厅名',
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT '电话',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '类型',
  `account_id` int(11) NOT NULL COMMENT '用户id',
  `menu_id` int(11) NOT NULL COMMENT '菜单id',
  `picture_id` int(11) NOT NULL COMMENT '图片id',
  PRIMARY KEY (`restaurant_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `name`, `address`, `phone`, `description`, `type`, `account_id`, `menu_id`, `picture_id`) VALUES
(1, '小朵颐', '曹安公路4800号', '18888888888', '好吃又便宜', '外卖', 1, 1, 1),
(2, '麦当劳', '曹安公路4800号', '18877787778', '快餐', '快餐', 2, 2, 2),
(3, '大多以', '杨浦区', '02168774589', '这是一家很厉害的餐厅', '快餐', 1, 1, 1),
(4, '喜多多', '中扽', '18878484218', '作为今年中国外交重头戏的“亚信峰会”将于20日在上海举行，昨天，外交部就此举行中外媒体吹风会。外交部副部长程国平介绍了峰会日程安排并指出，中国国家主席习近平夫妇将共同宴请峰会来宾，此外，习近平将发表主旨演讲，亚洲各国将发表《上海宣言》，宣示“亚洲主张”。', '快餐', 1, 1, 1),
(5, '习近平夫妇', '11国元首确认出席峰会', '42352345', '程国平介绍，亚信第四次峰会将于5月20日至21日在上海举行，习近平主席将主持峰会。截至目前，共有46个国家和国际组织领导人、负责人或代表确认应邀与会，其中包括11位国家元首、2位政府首脑及10位国际组织负责人。', '安全', 1, 1, 1),
(6, '个扔出仍', '广元人', '452345', '程国平介绍说，峰会将于21日全天在上海世博中心举行。峰会前夕，中方将在上海举行“和谐亚洲”国际和平艺术家绘画作品展，以及中国－上海合作组织国际司法交流合作培训基地奠基仪式。20日晚，习近平主席和夫人彭丽媛将为与会贵宾举行欢迎宴会，并共同观看文艺晚会。', '非常', 1, 1, 1),
(7, '娘惹', '眼让他', '562562345', '在11位即将到来的元首中，有4位将应习近平主席邀请，同时对华进行正式访问，他们是：俄罗斯总统普京、哈萨克斯坦总统纳扎尔巴耶夫、吉尔吉斯斯坦总统阿塔姆巴耶夫、伊朗总统鲁哈尼。\r\n', '陈个人', 1, 1, 1),
(8, 'rest', 'fdadsfasd', '6784567', 'this is test', '快餐', 3, 1, 1),
(9, 'rest3', 'fewfef', '18878484218', 'aaaaaaaaaaaaaa', '快餐', 4, 1, 1),
(10, 'restaurant4', 'address4', '666666', 'bbbbbbb', 'test', 3, 1, 1),
(11, 'restaurant5', 'address5', '66666666', 'bbbbbbbbb', 'test', 4, 1, 1),
(12, 'secondRequest1', 'address4', '666666', 'bbbbbbb', 'test', 3, 1, 1),
(13, 'secondRequest2', 'address5', '66666666', 'bbbbbbbbb', 'test', 4, 1, 1),
(16, '星巴克', '草案', '14444444444', '哈哈哈', '海鲜馆', 8, 5, 0),
(17, '小肥羊', '草案', '123131231313', '哈哈哈', '火锅', 9, 6, 0),
(18, '垃圾', '草案', '12313123', '哈哈哈', '烧烤', 10, 7, 0),
(19, '垃圾', '草案', '12313123', '哈哈哈', '烧烤', 11, 8, 10);

-- --------------------------------------------------------

--
-- 表的结构 `specialoffer`
--

CREATE TABLE IF NOT EXISTS `specialoffer` (
  `special_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '特供id',
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '类型',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `item_id` int(11) NOT NULL COMMENT '菜目id',
  `restaurant_id` int(11) NOT NULL COMMENT '餐厅id',
  PRIMARY KEY (`special_id`),
  KEY `item_id` (`item_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `table`
--

CREATE TABLE IF NOT EXISTS `table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '餐桌id',
  `table_no` int(11) NOT NULL COMMENT '餐桌号',
  `table_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '餐桌状态',
  `restaurant_id` int(11) NOT NULL COMMENT '餐厅id',
  `qrcode_id` int(11) NOT NULL COMMENT '二维码id',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  PRIMARY KEY (`table_id`),
  KEY `restaurant_id` (`restaurant_id`),
  KEY `qrcode_id` (`qrcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `table`
--

INSERT INTO `table` (`table_id`, `table_no`, `table_status`, `restaurant_id`, `qrcode_id`, `order_id`) VALUES
(1, 1, 'occupied', 1, 1, 18),
(2, 2, 'occupied', 1, 2, 8),
(3, 3, 'occupied', 1, 3, 9),
(4, 4, 'occupied', 1, 4, 10),
(5, 5, 'occupied', 1, 5, 0),
(6, 6, 'vacant', 1, 7, 0),
(7, 7, 'vacant', 1, 8, 0),
(8, 8, 'vacant', 1, 9, 0);

--
-- 限制导出的表
--

--
-- 限制表 `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);

--
-- 限制表 `hurry`
--
ALTER TABLE `hurry`
  ADD CONSTRAINT `hurry_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- 限制表 `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- 限制表 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `table` (`table_id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`table_id`) REFERENCES `table` (`table_id`);

--
-- 限制表 `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- 限制表 `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `picture_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- 限制表 `qrcode`
--
ALTER TABLE `qrcode`
  ADD CONSTRAINT `qrcode_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `qrcode_ibfk_4` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`);

--
-- 限制表 `specialoffer`
--
ALTER TABLE `specialoffer`
  ADD CONSTRAINT `specialoffer_ibfk_5` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `specialoffer_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `specialoffer_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `specialoffer_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `specialoffer_ibfk_4` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`);

--
-- 限制表 `table`
--
ALTER TABLE `table`
  ADD CONSTRAINT `table_ibfk_2` FOREIGN KEY (`qrcode_id`) REFERENCES `qrcode` (`qrcode_id`),
  ADD CONSTRAINT `table_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
