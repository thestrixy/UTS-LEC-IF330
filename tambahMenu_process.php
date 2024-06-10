<?php
session_start();
require_once('db.php');

$jenismenu = $_POST['jenismenu'];
$namamenu = $_POST['namamenu'];
$deskripsimenu = $_POST['deskripsimenu'];
$hargamenu = $_POST['harga'];

if (isset($_FILES['fotomenu']) && $_FILES['fotomenu']['error'] === UPLOAD_ERR_OK) {
    $fotomenu = $_FILES['fotomenu']['name'];
    $ext = pathinfo($fotomenu, PATHINFO_EXTENSION);

    $sql = "INSERT INTO menu (jenismenu, namamenu, deskripsi, harga, foto) VALUES ( ?, ?, ?, ?, ?)";

    switch ($ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'svg':
        case 'webp':
        case 'bmp':
        case 'gif':
            move_uploaded_file($_FILES['fotomenu']['tmp_name'], "fotomenu/{$fotomenu}");
            echo "File berhasil di upload";

            $stmt = $db->prepare($sql);
            $data = [$jenismenu, $namamenu, $deskripsimenu, $hargamenu, $fotomenu];
            $stmt->execute($data);
            header('Location: adminPage.php?success=1');
            break;
        default:
            echo "Anda hanya bisa upload file gambar";
    }
} else {
    echo "Terjadi kesalahan saat mengunggah file gambar.";
}
