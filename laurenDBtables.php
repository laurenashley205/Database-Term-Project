CREATE table Comments ( 		
 	c_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
 	comment VARCHAR(200),
 	e_id	INT,
    u_id    INT NOT NULL,
	FOREIGN KEY (e_id) REFERENCES events(e_id) ON DELETE CASCADE,
    FOREIGN KEY (u_id) REFERENCES events(u_id) ON DELETE CASCADE
);

CREATE TABLE events (
	e_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name		VARCHAR(20)	NOT NULL,
	description	TEXT NOT NULL,
	start_date	VARCHAR(20) NOT NULL,
    <!-- start_time  DATETIME NOT NULL, -->
    end_date	VARCHAR(20) NOT NULL,
    <!-- start_time  DATETIME NOT NULL, -->
	location    VARCHAR(20) NOT NULL,
	email       VARCHAR(50) NOT NULL,
	category	VARCHAR(20) NOT NULL,
	type		VARCHAR(20) NOT NULL,
	r_name		VARCHAR(30),
	r_id		INT,
    c_id        INT,
    comment    VARCHAR(200),
	FOREIGN KEY (r_id) REFERENCES Rsos(r_id),
    FOREIGN KEY (c_id) REFERENCES comments(c_id),
    FOREIGN KEY (comment) REFERENCES comments(comment)
)