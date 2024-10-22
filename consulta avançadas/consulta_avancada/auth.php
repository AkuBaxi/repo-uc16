<?php
session_start();

function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

function verificarAdmin() {
    if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
        header('Location: index.php?error=Acesso negado');
        exit;
    }
}

function fazerLogin($email, $senha) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['nivel'] = $usuario['nivel'];
            return true;
        }
        return false;
    } catch (PDOException $e) {
        return false;
    }
}

function fazerLogout() {
    session_destroy();
    header('Location: login.php');
    exit;
}