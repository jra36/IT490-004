CREATE TABLE IF NOT EXISTS Recipes(
                id int,
                title varchar(100),
                calories int,
		ingredient_1 varchar(100),
		ingredient_2 varchar(100),
		ingredient_3 varchar(100),
		url varchar(255),
		description varchar(255),
                primary key(id),
                created timestamp default current_timestamp,
                modified timestamp default current_timestamp on update current_timestamp
        )
