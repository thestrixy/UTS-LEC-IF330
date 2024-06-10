<?php
session_start();
require_once('db.php');

$pesanIdMenu = $_GET['menu_id'];
$harga = $_GET['harga'];
$id = $_SESSION['user_id'];

$sql = "SELECT jumlahpesanan, hargatotal FROM `order` WHERE idmenu = ? AND id = ? ";
$stmt = $db->prepare($sql);
$stmt->execute([$pesanIdMenu, $id]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    $queryInsert = "INSERT INTO `order` VALUES (?, ?, 1, ?)";
    $stmt = $db->prepare($queryInsert);
    $stmt->execute([$id, $pesanIdMenu, $harga]);
} else if ($row > 1) {
    $queryUpdate = 'UPDATE `order` SET jumlahpesanan = ' . ($row['jumlahpesanan'] + 1) . ',hargatotal = ' . ($row['hargatotal'] + $harga) . ' WHERE idmenu = ? AND id = ?';
    $stmt = $db->prepare($queryUpdate);
    $stmt->execute([$pesanIdMenu, $id]);
}
// echo "<pre>";
$referer = $_SERVER['HTTP_REFERER'];
// echo '<br/>';
$lastSlashPos = strrpos($referer, '/');
// echo '<br/>';
$baseUrl = substr($referer, 0, $lastSlashPos + 1);
// echo "</pre>";
if ($_SERVER['HTTP_REFERER'] == ($baseUrl . 'order.php'))
    header("location: order.php");
else header("location: index.php#sectionkategorimenu");
