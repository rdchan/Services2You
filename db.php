// This is an example of what db.php looks like, but the real db.php being used is
// hidden from the web as it contains sensitive information
<?php
    $servername='localhost';
    $username='hidden';
    $password='hidden';
    $dbname = "hidden";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
        die('Could not Connect MySql Server:' .mysql_error());
    }
?>
