<?php

    if(isset($_POST['submit'])){
        $to = "mrpotato1769@gmail.com";
        $from = $_POST['email'];
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $number = $_POST['number'];
        $cmessage = $_POST['message'];
    }

    $headers = "From: $from";
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $csubject = "You have a message from your Bitmap Photography.";

    $logo = 'img/logo.png';
    $link = '#';

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
    $body .= "<tr><td></td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    //$send = mail($to, $subject, $body, $headers);

    $dbhost = "localhost";
    $dbuser = "root";
    $pass = "root";
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
    $sql = "INSERT INTO contact(`sender`, `name`, `subject`, `number`, `message`) VALUES ('$from', '$name', '$subject', '$number', '$cmessage')";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    closeConn($conn);
    header("refresh:2; url=contact.html");
?>
