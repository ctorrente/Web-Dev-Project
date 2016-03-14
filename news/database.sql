drop database if exists dcs_site;
create database dcs_site;
use dcs_site;

create table users(
	username varchar(32) NOT NULL,
	password varchar(50) NOT NULL,
	first_name varchar(32) NOT NULL,
	last_name varchar(32) NOT NULL,
	user_type enum('S', 'C', 'O', 'T') NOT NULL,
	constraint user_pk primary key(username)
);

create table picture(
	picture_id int(11) AUTO_INCREMENT,
	file_name varchar(32),
	file_path varchar(32),
	constraint picture_id_pk primary key(picture_id) 
);

create table news(	
	news_id int(11) AUTO_INCREMENT NOT NULL,
	username varchar(32) NOT NULL,
	picture_id int(11),
	title varchar(100) NOT NULL,
	details text,
	date_posted datetime,
	constraint news_pk primary key(news_id),
	constraint user_id_news_fk foreign key(username) references users(username),
	constraint picture_id_picture_fk foreign key(picture_id) references picture(picture_id)
);

insert into users(username, password, first_name, last_name, user_type) 
	values('torrente_chac', '123456', 'Charles', 'Torrente', 'S');

insert into users(username, password, first_name, last_name, user_type) 
	values('fritz_olanz', '123456', 'Fritz', 'Olanz', 'C');

insert into users(username, password, first_name, last_name, user_type) 
	values('shara_u', '123456', 'Shara Mae', 'U', 'O');

insert into users(username, password, first_name, last_name, user_type) 
	values('adrian_pajarillo', '123456', 'Adrian', 'Pajarillo', 'T');