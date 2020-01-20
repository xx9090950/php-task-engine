# php-task-engine
使用tp6框架完成的任务引擎，抽象出定时执行任务，完成任务后修改任务状态。任务失败重新执行等逻辑，使业务方聚焦自己的任务。轻松完成计划任务的部署

使用之前，请composer update


数据表结构如下：


字段|类型|注释
----|----|----
id|int(11)|唯一主键
bus_type|int(11)|业务类型
bus_key|bigint(20)|业务id
remark|varchar(255)|备注
params|varchar(255)|可能会用到的参数
status|tinyint(1)|任务状态  1完成 2待执行 3结束 4失败重试
create_time|int(11)|创建时间
update_time|int(11)|更新时间

推荐阅读 个人博客[关于任务引擎的文章](https://www.jianshu.com/p/6afc3474e317)
