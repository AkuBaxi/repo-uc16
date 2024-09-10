<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $usanerman, $password, $dbname);

if($conn->connect_errno){
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT into usuarios (email, pass) VALUES(?, ?)");
$stmt->bind_param("ss",$email, $pass,);


if ($stmt ->execute() === TRUE) {
    echo "New recode created succesfully";
    header("Location: texte.html");
} else{
    echo "Error: " . $stmt->error;
    header("Localion: index.html");
}


$stmt->close();
$conn->close();
?>