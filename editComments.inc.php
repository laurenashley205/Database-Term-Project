<?php
	include_once 'header.html';
	include_once 'connect.inc.php';
	include 'methods.inc.php';
	// if(!isset($_SESSION["pid"])){
	// 	header("location: signup.php");
	// 	exit();
	// }
?>

<?php
$c_id = $_POST['c_id'];
$comment = $_POST['comment'];
$u_id = $_POST['u_id'];
$e_id = $_POST['e_id'];

echo "<form action='".editComments($conn)."' method='POST'>
        <p style='text-align: center'> Comment </p>
        <input type='hidden' name='c_id' value='".$_POST['c_id']."'>
        <input type='hidden' name='u_id' value='".$_POST['u_id']."'>
        <input type='hidden' name='e_id' value='" .$_POST['e_id']. "'>
        <textarea style='background-color:white; width=100%' name='comment'>".$comment."</textarea>
        <br><br><br>
        <button type='submit' name='submit-comment'>Update</button>
        <br><br><br>
    </form>";
?>