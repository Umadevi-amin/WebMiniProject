<?php
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$hosp = $_POST['hospital'];
		$message = $_POST['message'];
	}

	$dbhost = "localhost";
    $dbuser = "root";
    $pass = "";
    $db = "locator_feedback";
    function openConn($dbhost, $dbuser, $pass, $db){
        $conn = new mysqli($dbhost, $dbuser, $pass, $db) or die("Connection Failed ".$conn->error);
        return $conn;
    }
    function closeConn($conn){
        $conn->close();
    }
    $conn = openConn($dbhost, $dbuser, $pass, $db);
    if(!$conn)
        echo "Not Connected";
    $sql = "INSERT INTO appointment(`name`, `email`, `hospital`, `message`) VALUES ('$name', '$email', '$hosp', '$message')";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    closeConn($conn);
    header("refresh:0; url=department.html");
?>