<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($username === 'admin') {
            $_SESSION['admin'] = true;
            header('Location: admin.php');
            exit;
        } elseif ($username === 'Wagner') {
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit;
        } else {
            $_SESSION['username'] = $username;
            header('Location: painel.php');
            exit;
        }
    } else {
        echo 'Usuário ou senha inválidos.';
    }
}
?>
