CREATE table Users (
	u_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fname 		VARCHAR(20) NOT NULL,
	lname 		VARCHAR(20) NOT NULL,
    email 		VARCHAR(50) NOT NULL,
    u_pid		VARCHAR(10),
    password 	VARCHAR(20) NOT NULL,
	security	VARCHAR(10) NOT NULL
);

CREATE table Events (
	e_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name		VARCHAR(20)	NOT NULL,
	category	VARCHAR(20) NOT NULL,
    start_date	VARCHAR(20) NOT NULL,
    end_date	VARCHAR(20) NOT NULL,
    description	TEXT,
   	location	VARCHAR(50) NOT NULL,
    type		VARCHAR(20) NOT NULL,	//can either be public, private, or RSO name 
	email		VARCHAR(50) NOT NULL
   
);

CREATE table RSO (
	rso_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    
);

INSERT INTO Users (fname, lname, email, u_pid, password, security)
	VALUES ('Test', 'User', 'testuser@knights.ucf.edu', '415ghst', 'test123', 'student');
	
	
	
$sql = "SELECT * FROM Users WHERE fname = 'test';";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo $row['fname'];
			}
		}
		
		
		
		
