<?php
require_once('db.php');

// Data from Form
$namaDepan = $_POST['namadepan'];
$namaBelakang = $_POST['namabelakang'];
$username = $_POST['username'];
$tanggalLahir = $_POST['tanggallahir'];
$jenisKelamin = $_POST['jeniskelamin'];
$password = $_POST['password'];
$kodereff = $_POST['kodereff'];

// Encrypt the password
$en_pass = password_hash($password, PASSWORD_BCRYPT);

// Check if the username already exists
$checkUsernameQuery = "SELECT username FROM ms_user WHERE username = ?";
$checkUsernameResult = $db->prepare($checkUsernameQuery);
$checkUsernameResult->execute([$username]);
$existingUsername = $checkUsernameResult->fetchColumn();

if ($existingUsername) {
    header('location: register.php?username-taken=1');
} else {
    // Insert the user into the database
    if ($kodereff === 'admin123') {
        $sql = "INSERT INTO ms_user (namadepan, namabelakang, username, tanggallahir, gender, password, is_admin) VALUES (?, ?, ?, ?, ?, ?, 1)";
    } else {
        $sql = "INSERT INTO ms_user (namadepan, namabelakang, username, tanggallahir, gender, password, is_admin) VALUES (?, ?, ?, ?, ?, ?, 0)";
    }

    $result = $db->prepare($sql);
    $result->execute([$namaDepan, $namaBelakang, $username, $tanggalLahir, $jenisKelamin, $en_pass]);
    header('location: register.php');
}
