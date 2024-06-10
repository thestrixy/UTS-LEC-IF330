<?php
session_start();
require_once('db.php');

//Data from Form
$username = $_POST['username'];
$password = $_POST['password'];

//check if user exist
$sql = "SELECT * FROM ms_user WHERE username = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    header('location:register.php?notfound=1');
} else if (password_verify($password, $row['password']) && $_POST['captcha'] == $_POST['confirmcaptcha']) {
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role'] = $row['is_admin'];
    $_SESSION['username'] = $row['username'];
    header('location:index.php');
} else {
    header('location:register.php?error=1');
}
