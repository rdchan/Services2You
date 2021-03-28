<?php
include_once '../db.php';
if(isset($_POST['submit']))
{    
    /*
    echo '<script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pullPosition);
            } else {
                alert("Your browser does not support geolocation");
            }
        }
        function pullPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        alert("whoa");
        }
        getLocation();
    </script>';
     */
    function getUserIP() {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

    $ipAddr = getUserIP();
    $geoIP  = json_decode(file_get_contents("http://api.ipstack.com/$ipAddr?access_key=$apikey"), true);
    $sketchylat = $geoIP['latitude'];
    $sketchylon = $geoIP['longitude'];
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phonenumber'];
    $zip     = $_POST['zipcode'];
    $comment = $_POST['comment'];
    $service = $_POST['service'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $sql = "INSERT INTO dummy_db.requests (name,email,phone,zip,msg,service, latitude, longitude)
    VALUES ('$name','$email','$phone','$zip','$comment','$service', '$sketchylat', '$sketchylon' )";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.html');
        //echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
