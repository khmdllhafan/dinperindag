<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT * FROM user WHERE username = ?");
$query->execute([$username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $username;
    header('Location: user/dashboard.php');
} else {
    echo "<script>alert('Username atau Password salah!'); window.location.href = 'index.php';</script>";
}
?>
