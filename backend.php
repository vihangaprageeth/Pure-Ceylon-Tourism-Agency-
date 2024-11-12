<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sri_lanka_tourism";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];
    $package_name = $_POST['package_name'];
    $package_type = $_POST['package_type'];
    $travel_date = $_POST['travel_date'];
    $number_of_travelers = $_POST['number_of_travelers'];
    $preferences = $_POST['preferences'];
    $message = $_POST['message'];
    $newsletter = isset($_POST['newsletter']) ? 1 : 0; 
    $terms_accept = isset($_POST['terms_accept']) ? 1 : 0; 
    $captcha = $_POST['captcha'];

 
    if ($captcha != '5') { 
        die("Captcha answer is incorrect.");
    }


    $sql = $conn->prepare("INSERT INTO enquiries (name, email, password, mobile_number, package_name, package_type, travel_date, number_of_travelers, preferences, message, newsletter, terms_accept, captcha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    

    $sql->bind_param("sssssssssssss", $name, $email, $password, $mobile_number, $package_name, $package_type, $travel_date, $number_of_travelers, $preferences, $message, $newsletter, $terms_accept, $captcha);

  
    if ($sql->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql->error;
    }


    $sql->close();
}


$conn->close();
?>
