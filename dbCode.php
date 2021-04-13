CREATE table Users ( 		
	u_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fname 		VARCHAR(20) NOT NULL,
	lname 		VARCHAR(20) NOT NULL,
    email 		VARCHAR(50) NOT NULL,
    u_pid		VARCHAR(10) NOT NULL UNIQUE,			
    password 	VARCHAR(20) NOT NULL,
	university	VARCHAR(20) NOT NULL,
	security	VARCHAR(10) NOT NULL
);

CREATE table Events (		//include the email of the user who created the event and the university the user attends 
	e_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,	
	name		VARCHAR(20)	NOT NULL,
	category	VARCHAR(20) NOT NULL,	//social, fundraising, tech talk
    start_date	VARCHAR(20) NOT NULL,
    end_date	VARCHAR(20) NOT NULL,
	picture********************************************************
    description	TEXT,
    type		VARCHAR(20) NOT NULL,	//can either be public, private, or RSO name 
	approved	INT NOT NULL,			//0 if student made it 1 if superadmin approved it
	//email comes from u_id search 
	//location comes from u_id search 
	r_id		INT FOREIGN KEY REFERENCES Rsos(r_id),
	u_id		INT FOREIGN KEY REFERENCES Users(u_id)
);

CREATE table Comments (			
	e_id 		INT NOT NULL PRIMARY KEY,	
	u_id		INT	NOT NULL PRIMARY KEY,
	comment   	TEXT NOT NULL,
	rating		INT NOT NULL,
	date		DATE NOT NULL
	
);

CREATE table Rsos (		//include the university the admin attends. To find a list of all users select all users with their u_id in the rso 
	r_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name		VARCHAR (20) NOT NULL UNIQUE,
	type 		VARCHAR(20) NOT NULL
	picture**********************************************
    //location comes from u_id search
);

CREATE table Rso_members(
    ind 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	r_id		INT NOT NULL,
    u_id 		INT NOT NULL,
    FOREIGN KEY(r_id) REFERENCES Rsos(r_id),
    FOREIGN KEY(u_id) REFERENCES Users(u_id)
);

CREATE table Universities(		//has rso's, events, super admin 
	uni_id		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name		VARCHAR(20) NOT NULL,
	num_students INT NOT NULL,	//everytime someone signs up under that uni this value increases
	picture**********************************************
);


INSERT INTO Users (fname, lname, email, u_pid, password, university, security)
	VALUES ('Test', 'User', 'testuser@knights.ucf.edu', '415ghst', 'test123', 'UCF','student');
	
INSERT INTO Comments(e_id,u_pid,comment,rating,date) VALUES('$eidfromevent','$pidfromuser','comment','5',getdate());
	
$sql = "SELECT * FROM Users WHERE fname = 'test';";				//gets list of ALL users named test and stores the whole row of info 
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo $row['fname'];
			}
		}
		
		
		
		
