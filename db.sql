CREATE TABLE IF NOT EXISTS `wx_news` (
  `id` MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '',
  `title` VARCHAR(20) NOT NULL DEFAULT '' COMMENT 'title',
  `desc` VARCHAR(20) NOT NULL DEFAULT '' COMMENT 'desc',
  `picurl` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '',
  `url` VARCHAR(30) NOT NULL DEFAULT '',
  `type` VARCHAR(20) NOT NULL DEFAULT ''

) ENGINE MyISAM DEFAULT CHARSET = UTF8 COMMENT 'wx_news';

INSERT INTO `wx_news` (`title`, `desc`,`picurl`, `url`,`type`) VALUES ('test1', 'this is test1', 'http://wx.dpxiao.com/image/myimage.jpg', 'https://www.baidu.com','girl');
INSERT INTO `wx_news` (`title`, `desc`,`picurl`, `url`,`type`) VALUES ('test2', 'this is test2', 'http://wx.dpxiao.com/image/myimage.jpg', 'https://www.baidu.com','girl');
INSERT INTO `wx_news` (`title`, `desc`,`picurl`, `url`,`type`) VALUES ('test3', 'this is test3', 'http://wx.dpxiao.com/image/myimage.jpg', 'https://www.baidu.com','girl');
INSERT INTO `wx_news` (`title`, `desc`,`picurl`, `url`,`type`) VALUES ('test4', 'this is test4', 'http://wx.dpxiao.com/image/myimage.jpg', 'https://www.baidu.com','girl');