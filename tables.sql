create schema dbpro; 
use dbpro; 

create table user_login(
	email varchar(30) primary key,
	passwd varchar(30)
);

create table food_items(
	prod_id int primary key auto_increment,
	name varchar(30),
	company varchar(30),
	quantity int,
	price int,
	expiry date,
	user_id int,
	upload_date date,
	description varchar(50)
);
ALTER TABLE food_items AUTO_INCREMENT = 1001; 


create table tech_items(
	prod_id int primary key auto_increment,	
	name varchar(30),
	company varchar(30),
	version varchar(30),
	quantity int,
	orig_price int,
	seller_price int,
	user_id int,
	upload_date date,
	description varchar(50)
);
ALTER TABLE tech_items AUTO_INCREMENT = 2001;



create table house_items(
	prod_id int primary key auto_increment,
	name varchar(30),
	quantity int,
	price int,
	user_id int,
	upload_date date,
	description varchar(50)
);
ALTER TABLE house_items AUTO_INCREMENT = 3001;


create table waste(
	prod_id int primary key auto_increment, 
	user_id int,
	description varchar(50),
	upload_date date
);
ALTER TABLE waste AUTO_INCREMENT = 5001;


create table charity(
	prod_id int primary key auto_increment,
	user_id int,
	description varchar(50),
	upload_date date
);
ALTER TABLE charity AUTO_INCREMENT = 4001;

create table user_addr(
	user_id int primary key,
	fname varchar(30),
	lname varchar(30),
	email varchar(30),
	address varchar(50),
	phone bigint
);


create table transactions(
	trans_id int primary key auto_increment,	
	seller_id int,
	buyer_id int,
	tstamp date,
	prod_id int,
	prod_name varchar(30)

);
ALTER TABLE transactions AUTO_INCREMENT = 6001;

create trigger date_house before insert on house_items for each row set new.upload_date = now();
create trigger date_food before insert on food_items for each row set new.upload_date = now();
create trigger date_tech before insert on tech_items for each row set new.upload_date = now();
create trigger transaction before insert on transactions for each row set new.tstamp = CURRENT_TIMESTAMP();
create trigger date_charity before insert on charity for each row set new.upload_date = now();
create trigger date_waste before insert on waste for each row set new.upload_date = now();







