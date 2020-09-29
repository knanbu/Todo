create database todo_db;
use todo_db;
create table Member(
    member_id int auto_increment,
    member_name varchar(100) not null,
    email varchar(100) not null,
    pass varchar(200) not null,
    primary key(member_id)
);
create table Category(
    category_id int auto_increment,
    c_name varchar(100) not null,
    primary key(category_id)
);
create table Answer(
    answer_id int auto_increment,
    question_id int not null,
    member_id int not null,
    a_content varchar(100) not null,
    primary key(answer_id)
);
create table Question(
    question_id int auto_increment,
    q_content varchar(100) not null,
    primary key(question_id)
);

create table Task(
    task_id int auto_increment,
    member_id int not null,
    task_name varchar(300) not null,
    `priority` int,
    `start_date` date,
    limit_date date,
    comment varchar(1000),
    primary key(task_id)
);

create table TCList(
    tc_id int auto_increment,
    task_id int not null,
    category_id int not null,
    primary key(tc_id)
);

