<?php
	include_once 'header.html';
	include_once 'methods.inc.php';
	
	if(isset($_GET["update"])){
		$cid = $_GET['update'];
		$commentInfo = CommentExists($conn,$cid);
		$old = $commentInfo["comment"];
	}
	else if (isset($_GET["delete"])){
		$cid = $_GET['delete'];
		DeleteComment($conn,$cid);
		header("location: searchEvent.php");
		exit();
	}
	
?>

<form action="editComment.inc.php" method="POST">
		<input style="background-color: white; width:97%; margin-left: -70px; margin-top:20px;border: none;" type="text" name="cid" value = "<?php echo $cid?>">
		<textarea style="background-color: #f1f1f1; width:100%; margin-left: -70px; margin-top:20px; border:1px solid black;" type="text" name="comment"> <?php echo $old ?></textarea>
		<button style="background-color: #f1f1f1; margin-left: 90px; margin-bottom: 20px; background-color: white;" type="submit" name="submit" value="comment">Update</button>
	</form>