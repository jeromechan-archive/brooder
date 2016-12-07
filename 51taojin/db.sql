USE app_taojin;

CREATE TABLE `tj_user_finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `balance` int(11) NOT NULL DEFAULT '0' COMMENT '账户余额',
  `all_balance` int(11) NOT NULL DEFAULT '0' COMMENT '累计收入',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `del_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除标记',
  `misc` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户财务表';

CREATE TABLE `tj_user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `mobile_number` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别,1=男，2=女',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `alipay_name` varchar(255) NOT NULL DEFAULT '' COMMENT '支付宝姓名',
  `alipay_number` varchar(255) NOT NULL DEFAULT '' COMMENT '支付宝帐号',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `del_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除标记',
  `misc` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';