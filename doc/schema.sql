
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
    journal_type ENUM("Deity", "NPC", "Player Account", "Crew Notes", "Other"),
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
    read_by_story tinyint,
    date_created tinyint,
    PRIMARY KEY(id)
)