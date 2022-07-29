create table employees
(
    id         int(5) unsigned auto_increment
        primary key,
    first_name varchar(100) not null,
    last_name  varchar(100) not null,
    position   varchar(100) not null,
    created_at datetime     not null
)
    charset = utf8mb3;

create table migrations
(
    id        bigint unsigned auto_increment
        primary key,
    version   varchar(255)     not null,
    class     varchar(255)     not null,
    `group`   varchar(255)     not null,
    namespace varchar(255)     not null,
    time      int              not null,
    batch     int(11) unsigned not null
)
    charset = utf8mb3;


