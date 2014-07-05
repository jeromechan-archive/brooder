create table `cspt_user`(
	`id` int not null auto_increment comment '用户ID',
	`username` varchar(50) not null default '' comment '用户名',
	`nickname` varchar(50) not null default '' comment '昵称',
	`level` tinyint not null default 0 comment '等级，0=一般用户，-1=管理员',
	`password` varchar(50) not null default '' comment '登录密码',
	`email` varchar(50) not null default '' comment '邮箱',
	`remark` varchar(50) not null default '' comment '备注',
	`del_flag` tinyint not null default 0 comment '删除标识，0=正常，1=删除',
	primary key (`id`),
  unique key (`username`)
)engine=innodb auto_increment=1 default charset=utf8 comment '用户表';

create table `cspt_profile`(
	`id` int not null auto_increment comment '主键',
	`user_id` int not null default 0 comment '用户ID',
	`introduction` varchar(255) not null default '' comment '简介',
	`remark` varchar(50) not null default '' comment '备注',
	`del_flag` tinyint not null default 0 comment '删除标识，0=正常，1=删除',
	primary key (`id`)
)engine=innodb auto_increment=1 default charset=utf8 comment '用户资料表';

create table `cspt_snippet`(
	`id` int not null auto_increment comment '主键',
	`user_id` int not null default 0 comment '用户ID',
	`name` varchar(50) not null default '' comment '片段名称',
	`language` varchar(50) not null default '' comment '语言',
	`tags` varchar(255) not null default '' comment '标签',
	`contents` varchar(255) not null default '' comment '内容',
	`remark` varchar(50) not null default '' comment '备注',
	`del_flag` tinyint not null default 0 comment '删除标识，0=正常，1=删除',
	primary key (`id`)
)engine=innodb auto_increment=1 default charset=utf8 comment '代码片段表';
