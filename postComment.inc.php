<?php
	include_once 'header.html';
	include_once 'connect.inc.php';
	include 'methods.inc.php';
	
	// $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // setComments($conn);

    // if(isset($_POST["submit-comment"])){
        // $c_id = $_POST['c_id'];
		// $comment = $_POST['comment'];
		// $u_id = $_POST['u_id'];
		// $e_id = $_POST['e_id'];

		// $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		// $u_id = mysqli_real_escape_string($conn, $_POST['u_id']);
		// $e_id = mysqli_real_escape_string($conn, $_POST['e_id']);
			
		// $sql = "INSERT INTO Comments (comment, u_id, e_id) VALUES (?,?,?);";
		$sql = "INSERT INTO Comments (comment) VALUES (?);";


		$stmt = mysqli_stmt_init($conn);

   		if(!mysqli_stmt_prepare($stmt,$sql)){
	   		header("location: viewEvent.php?error=stmtfailed");
	   		exit();
	   		// echo "SQL ERROR!";
   		} else{
	  		// mysqli_stmt_bind_param($stmt,"sss", $comment, $u_id, $e_id);
              mysqli_stmt_bind_param($stmt,"s", $comment);

	   		mysqli_stmt_execute($stmt);
	   		mysqli_stmt_close($stmt);
	   		header("location: profile.php?comment=posted");

	   		exit();
   		}

    // }



	// $sql = "INSERT INTO Comments (c_id, comment, u_id, e_id) VALUES (?,?,?,?);";

 	// $stmt = mysqli_stmt_init($conn);

    // if(!mysqli_stmt_prepare($stmt,$sql)){
    //     header("location: seeEvent.php?error=stmtfailed");
    //     exit();
    //     // echo "SQL ERROR!";
    // } else{
    //     mysqli_stmt_bind_param($stmt,"ssss",$c_id, $comment, $u_id, $e_id);
    //     mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);
    //     header("location: profile.php?comment=posted");

    //     exit();
    // }

    // function getComments($conn){
    //     $sql = "SELECT * FROM comments";

    //     $result = mysqli_query($conn, $sql);
    //     $resultCheck = mysqli_num_rows($result);
    //     if($resultCheck > 0){
    //         while($row = mysqli_fetch_assoc($result)){
    //             echo "<div class='general-screen'>";
    //             echo "<p>USER: " .$row['u_id'] . "</p>";
    //             echo "<p>COMMENT: " .$row['comment'] . "</p>";
    //             echo "<br>";
    //             echo "<p align=center> _________________________________________________________________ </p>";
    //             echo "<br><br><br><br><br>";
    //             echo "</div>";
    //         }
    //     }
        
    // }
		
?>