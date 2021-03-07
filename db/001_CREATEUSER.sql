CREATE TABLE IF NOT EXISTS Users(
		id int not null auto_increment,
		email varchar(100) not null,
		password varchar(60) not null,
		primary key(id),
		unique(email),
		created timestamp default current_timestamp,
		modified timestamp default current_timestamp on update current_timestamp;
		
	)
