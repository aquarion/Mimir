
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
    `character_name` varchar(255),
    `group` varchar(255),
    `nation` varchar(255),
    `path` varchar(255),
    `kit` tinyint,
    `email` varchar(255),
    `event_id` tinyint not null,
     primary key(pid,character_name,event_id)
);

alter table kudos add column champion_id int null after date_created;
alter table kudos add column champion_name varchar(255) null after date_created;


create table greater_mystery (
    id bigint auto_increment,
    event_id TINYINT,
    name varchar(255),
    mystery_type varchar(63),
    aquisition_type varchar(63),
    effect_type varchar(63),
    territory varchar(255),
    culture varchar(255),
    prime varchar(255),
    drachma int,
    quin_earth int,
    quin_air int,
    quin_fire int,
    quin_water int,
    blood int,
    extra_requirements text,

    short_desc varchar(255),
    flavour text,
    sign_requirement tinytext,
    duration varchar(255),
    effect text,
    enhancements text,
    
    date_created datetime,
    PRIMARY KEY(id)
);

create table blessing (
    id bigint auto_increment,
    copied_from bigint null,
    name tinytext,
    issuer tinytext,
    target_id int,
    target_name tinytext,
    description text,
    effect text,
    event_id tinyint,
    review_mark tinyint,
    game_notes text,
    duration tinytext,
    author tinytext,
    PRIMARY KEY(id)
)