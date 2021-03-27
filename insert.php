<?php
include_once '../db.php';
if(isset($_POST['submit']))
{    
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phonenumber'];
    $zip     = $_POST['zipcode'];
    $comment = $_POST['comment'];
    $sql = "INSERT INTO dummy_db.requests (name,email,phone,zip,msg,service)
    VALUES ('$name','$email','$phone','$zip','$comment','$service')";
    if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
