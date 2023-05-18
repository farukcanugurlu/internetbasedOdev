<?php
$servername = "localhost";
$username = "farukcan";
$password = "farukcan1234";
$dbname = "students";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    $errors = array();
    if (empty($fullname)) {
        $errors[] = "Full Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Address.";
    }
    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$fullname', '$email', '$gender')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    $conn->close();
}
?>