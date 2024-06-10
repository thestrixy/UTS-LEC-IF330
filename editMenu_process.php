<?php
require_once('db.php');

$idmenu = $_POST["idmenu"];
$jenismenu = $_POST["jenismenu"];
$namamenu = $_POST["namamenu"];
$deskripsimenu = $_POST["deskripsimenu"];
$hargamenu = $_POST["hargamenu"];

if (!empty($_FILES['fotomenu']['name'])) {
    $foto_name = $_FILES['fotomenu']['name'];
    $foto_tmp = $_FILES['fotomenu']['tmp_name'];

    $foto_path = 'fotomenu/' . $foto_name;
    move_uploaded_file($foto_tmp, $foto_path);
    $sql = $db->prepare("UPDATE menu SET jenismenu = :jenismenu, namamenu = :namamenu, deskripsi = :deskripsimenu, harga = :hargamenu, foto = :fotomenu WHERE idmenu = :idmenu");
    $sql->bindParam(':jenismenu', $jenismenu);
    $sql->bindParam(':namamenu', $namamenu);
    $sql->bindParam(':deskripsimenu', $deskripsimenu);
    $sql->bindParam(':hargamenu', $hargamenu);
    $sql->bindParam(':fotomenu', $foto_name);
    $sql->bindParam(':idmenu', $idmenu);
} else {
    $sql = $db->prepare("UPDATE menu SET jenismenu = :jenismenu, namamenu = :namamenu, deskripsi = :deskripsimenu, harga = :hargamenu WHERE idmenu = :idmenu");
    $sql->bindParam(':jenismenu', $jenismenu);
    $sql->bindParam(':namamenu', $namamenu);
    $sql->bindParam(':deskripsimenu', $deskripsimenu);
    $sql->bindParam(':hargamenu', $hargamenu);
    $sql->bindParam(':idmenu', $idmenu);
}

if ($sql->execute()) {
    header('Location: adminPage.php?editsuccess=1');
    // exit;
} else {
    header('Location: adminPage.php?editfail=1');
    // echo "Gagal update data";
}
