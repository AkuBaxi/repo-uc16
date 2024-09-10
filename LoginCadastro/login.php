<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username,  $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];


    $sql = "SELECT pass FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pass_hash = $row["pass"];

            if (password_verify($pass, $pass_hash)) {
            $sql = "SELECT email FROM usuarios WHERE email = '$email'";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();

            session_start();
            $_SESSION['user_email'] = $user['email'];
            header("Location: home.html");
            exit();
        } else {
            
            header("Location: erro.html");
            exit();
        }
    } else {
    
        header("Location: erro.html");
        exit();
    }

    $conn->close();
    
}
?>
