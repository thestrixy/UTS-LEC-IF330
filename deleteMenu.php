<?php
session_start();

require_once('db.php');

$idmenu = $_GET['idmenu'];

$deleteOrderSql = "DELETE FROM `order` WHERE idmenu = :idmenu";
$stmt = $db->prepare($deleteOrderSql);
$stmt->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
$stmt->execute();


$deleteSql = "DELETE FROM menu WHERE idmenu = :idmenu";
$stmt = $db->prepare($deleteSql);
$stmt->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
$stmt->execute();
header('Location: adminPage.php');
exit();