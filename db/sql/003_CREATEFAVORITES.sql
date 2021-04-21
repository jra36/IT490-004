CREATE TABLE IF NOT EXISTS Favorites(
		favorite_id int not null auto_increment,
		id int not null,
		user_id int not null,
                recipe_id int not null,
                comment text(100) not null,
                PRIMARY KEY (favorite_id),
		FOREIGN KEY (user_id) REFERENCES Users(id),
		FOREIGN KEY (recipe_id) REFERENCES Recipes(id),
                created timestamp default current_timestamp,
                modified timestamp default current_timestamp on update current_timestamp
        )
