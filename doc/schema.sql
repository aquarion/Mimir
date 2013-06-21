
create table kudos (
    id bigint auto_increment,
    event_id TINYINT,
    sacrifice_type varchar(63),
    priest_id int,
    priest_name varchar(255),
    group_name varchar(255),
    nation varchar(31),
    deity varchar(255),
    lives int,
    life_bonus int,
    arena_bonus int,
    chalkoi int,
    obol int,
    drachma int,
    pentadrachma int,
    mina int,
    quin_earth int,
    quin_air int,
    quin_fire int,
    quin_water int,
    total int,
    notes text,
    date_created datetime,
    PRIMARY KEY(id)
);


create table journal (
    id bigint auto_increment,
    journal_type varchar(255),
    title varchar(255),
    description text,
    PRIMARY KEY(id)
);

create table entry (
    id bigint auto_increment,
    journal_id INT NULL, 
    event tinyint,
    title varchar(255),
    content mediumtext,
    physrep varchar(255),
    author varchar(255),
    unread_by_story TINYINT(4) DEFAULT 1 NULL,
    attention_flag TINYINT(4) DEFAULT 0 NULL,
    date_created tinyint,
    PRIMARY KEY(id)
)

create table player (
    `pid` int null,
    `player` varchar(255),
    `location` varchar(255),
    `character` varchar(255),
    `group` varchar(255),
    `nation` varchar(255),
    `path` varchar(255),
    `kit` tinyint,
    `email` varchar(255),
    `event` tinyint not null,
    primary key(pid,event)
);

alter table kudos add column champion_id int null after date_created;
alter table kudos add column champion_name varchar(255) null after date_created;