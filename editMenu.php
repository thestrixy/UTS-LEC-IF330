<?php
session_start();
require('db.php');
$idmenu = isset($_GET['idmenu']) ? $_GET['idmenu'] : null;

if ($idmenu !== null) {
    $sql = "SELECT * FROM menu WHERE idmenu = :idmenu";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':idmenu', $idmenu, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran IF330-I</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="./assets/css/stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="./assets/images/hero-banner.png" media="min-width(768px)">
    <link rel="preload" as="image" href="./assets/images/hero-banner-bg.png" media="min-width(768px)">
    <link rel="preload" as="image" href="./assets/images/hero-bg.jpg">

</head>
<style>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 1) { ?>.navbar.active {
        height: 230px;
        visibility: visible;
    }

    <?php } else if (isset($_SESSION['user_id']) && $_SESSION['role'] == 0) { ?>.navbar.active {
        height: 190px;
        visibility: visible;
    }

    <?php } else { ?>.navbar.active {
        height: 150px;
        visibility: visible;
    }

    <?php } ?>
</style>

<body id="top">
    <div class="bg-white-0">
        <div style="background-image: url('./assets/images/hero-bg.jpg')">
            <header class="header" data-header>
                <div class="container">

                    <h1>
                        <a href="index.php" class="logo">Mangan<span class="span">.</span></a>
                    </h1>

                    <nav class="navbar" data-navbar>
                        <ul class="navbar-list">
                            <li class="nav-item">
                                <a href="adminPage.php" class="navbar-link" data-nav-link>Admin Page</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php" class="navbar-link" data-nav-link>Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="tambahMenu.php" class="navbar-link" data-nav-link>Tambah Menu</a>
                            </li>

                            <button class="btn btn-hover" onclick="window.location.href='logout.php'">Log Out</button>
                        </ul>
                    </nav>

                    <div class="header-btn-group">

                        <button class="nav-toggle-btn" aria-label="Toggle Menu" data-menu-toggle-btn>
                            <span class="line top"></span>
                            <span class="line middle"></span>
                            <span class="line bottom"></span>
                        </button>
                    </div>

                </div>
            </header>
            <section class="hero" id="home">
                <div class="container" data-aos="fade-up-left">
                    <form action="editMenu_process.php" class="footer-form" enctype="multipart/form-data" method="POST">
                        <p class="footer-list-title">Add New Menu</p>
                        <div class="input-wrapper">
                            <input type="text" name="idmenu" value="<?= $row['idmenu'] ?>" hidden>
                            <input type="text" name="namamenu" placeholder="Nama Menu" class="input-field" value="<?= $row['namamenu'] ?>" required>
                            <input type="number" name="hargamenu" placeholder="Rp. 1000" class="input-field" value="<?= $row['harga'] ?>" required>
                        </div>

                        <div class="input-wrapper">
                            <select name="jenismenu" aria-label="Total person" class="input-field" required>
                                <option value="<?= $row['jenismenu'] ?>" hidden><?= $row['jenismenu'] ?></option>
                                <option value="Appetizer">Appetizer</option>
                                <option value="Main course">Main Course</option>
                                <option value="Drink">Drink</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Snack">Snacks</option>
                            </select>
                            <input type="file" name="fotomenu" class="input-field">
                        </div>
                        <textarea name="deskripsimenu" placeholder="Description" aria-label="Message" class="input-field" required><?= $row['deskripsi'] ?></textarea>
                        <div class="input-wrapper">
                            <button type="submit" class="btn" style="background-color: var(--bg-color, var(--deep-saffron))">Edit</button>
                            <button type="button" class="btn" style="background-color: red" onclick="window.location.href='deleteMenu.php?idmenu=<?= $idmenu ?>'">Delete</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <footer class="footer">
            <div class="footer-top" style="background-image: url('./assets/images/footer-illustration.png')">
                <div class="container">

                    <div class="footer-brand">

                        <a href="" class="logo">Mangan<span class="span">.</span></a>

                        <p class="footer-text">
                            Financial experts support or help you to to find out which way you can raise your funds more.
                        </p>

                        <ul class="social-list">

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-twitter"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-pinterest"></ion-icon>
                                </a>
                            </li>

                        </ul>

                    </div>




                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <p class="copyright-text">
                        &copy; 2023 <a href="#" class="copyright-link">Mangan.</a> All Rights Reserved.
                    </p>
                </div>
            </div>

        </footer>
        <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
            <ion-icon name="chevron-up"></ion-icon>
        </a>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="./assets/js/script.js" defer></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <script>
            AOS.init();
        </script>
</body>

</html>