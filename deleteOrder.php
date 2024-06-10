<?php
session_start();
require_once('db.php');

$idmenu = $_GET['idmenu'];
$id = $_SESSION['user_id'];

$sqlHargaPerMenu = "SELECT harga FROM menu WHERE idmenu = ?";
$stmt = $db->prepare($sqlHargaPerMenu);
$stmt->execute([$idmenu]);
$hasil = $stmt->fetch(PDO::FETCH_ASSOC);

$hargaSatuan = $hasil['harga'];

$sql = "SELECT jumlahpesanan, hargatotal FROM `order` WHERE idmenu = ? AND id = ? ";
$stmt = $db->prepare($sql);
$stmt->execute([$idmenu, $id]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row['jumlahpesanan'] == 1) {
    $queryDelete = "DELETE FROM `order` WHERE idmenu = ? AND id = ?";
    $stmt = $db->prepare($queryDelete);
    $stmt->execute([$idmenu, $id]);
} else if ($row > 1) {
    $queryUpdate = 'UPDATE `order` SET jumlahpesanan = ' . ($row['jumlahpesanan'] - 1) . ',hargatotal = ' . ($row['hargatotal'] - $hargaSatuan) . ' WHERE idmenu = ? AND id = ?';
    $stmt = $db->prepare($queryUpdate);
    $stmt->execute([$idmenu, $id]);
}
header("location: order.php");
