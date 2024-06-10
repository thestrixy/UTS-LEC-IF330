<?php
session_start();

if ($_SESSION['role'] == 0)
    header('location: index.php');

$successMessage = '';
if (isset($_GET['success'])) {
    $successMessage = '<br/><div class="alert alert-success text-center my-6 text-white">Data berhasil di Insert.</div>';
}

require('db.php');

$sql = "SELECT * FROM menu";

$hasil = $db->query($sql);
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
    @media (max-width: 990px) {
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
    }
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
                            <?php
                            if (isset($_SESSION['role'])) if ($_SESSION['role'] == 1) { ?>
                                <li class="nav-item">
                                    <a href="#" class="navbar-link" data-nav-link>Admin Page</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a href="index.php" class="navbar-link" data-nav-link>Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="tambahMenu.php" class="navbar-link" data-nav-link>Add Menu</a>
                            </li>
                            <li class="nav-item">
                                <a href="order.php" class="navbar-link" data-nav-link>Cart</a>
                            </li>
                            <?php if (!isset($_SESSION['user_id'])) { ?>
                                <button class="btn btn-hover" onclick="window.location.href='register.php'">Sign In</button>
                            <?php } else { ?>
                                <button class="btn btn-hover" onclick="window.location.href='logout.php'">Log Out</button>
                            <?php } ?>
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
                <?php if (isset($_GET['editfail']) && $_GET['editfail'] == 1) { ?>
                    <h1 style="text-align: center; color: white;">Edit Menu Failed</h1>
                <?php } ?>
                <div class="container" data-aos="fade-up-left">

                    <ul class="fiter-list">
                        <li>
                            <button class="filter-btn active" data-category="all">All</button>
                        </li>
                        <li>
                            <button class="filter-btn" data-category="Appetizer">Appetizers</button>
                        </li>
                        <li>
                            <button class="filter-btn" data-category="Main course">Main Courses</button>
                        </li>
                        <li>
                            <button class="filter-btn" data-category="Drink">Drinks</button>
                        </li>
                        <li>
                            <button class="filter-btn" data-category="Dessert">Desserts</button>
                        </li>
                        <li>
                            <button class="filter-btn" data-category="Snack">Snacks</button>
                        </li>
                    </ul>
                    <ul class="food-menu-list">
                        <?php
                        $sql = "SELECT * FROM menu";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <li class="menu-item" data-category="<?= $row['jenismenu'] ?>">
                                <div class="food-menu-card">
                                    <div class="card-banner">
                                        <?php echo '<img src="fotomenu/' . $row["foto"] . '" width="300" height="300" loading="lazy" alt="Foto" class="w-100">'; ?>
                                        <button class="btn food-menu-btn" onclick="window.location.href='editMenu.php?idmenu=<?= $row['idmenu'] ?>'">Edit Menu</button>
                                    </div>
                                    <div class="wrapper">
                                        <p class="category"><?= $row['jenismenu'] ?></p>
                                        <div class="rating-wrapper">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                    </div>
                                    <h3 class="h3 card-title"><?= $row['namamenu'] ?></h3>
                                    <div class="price-wrapper">
                                        <p class="price-text">Price:</p>
                                        <data class="price">Rp. <?= $row['harga'] ?></data>
                                    </div>
                                    <p class="h4 card-description text-left"><?= $row['deskripsi'] ?></p>
                                </div>
                            </li>
                        <?php }
                        ?>
                        <?php
                        if (isset($_SESSION['role'])) if ($_SESSION['role'] == 1) { ?>
                            <li>
                                <div class="food-menu-card">
                                    <div class="card-banner">
                                        <img src="./assets/images/piring.png" width="900" height="900" loading="lazy" alt="Fried Chicken Unlimited" class="w-100">
                                        <button class="btn food-menu-btn" onclick="window.location.href='tambahMenu.php'">Add New</button>
                                    </div>
                                    <div class="wrapper">
                                        <p class="category">Category</p>
                                        <div class="rating-wrapper">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                    </div>
                                    <h3 class="h3 card-title">Nama Makanan</h3>
                                    <div class="price-wrapper">
                                        <p class="price-text">Price:</p>
                                        <data class="price">Rp. 000</data>
                                    </div>
                                    <p class="h4 card-description text-left">Deskripsi</p>

                                </div>
                            </li>
                        <?php } ?>
                    </ul>
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
            document.addEventListener("DOMContentLoaded", function() {
                const filterButtons = document.querySelectorAll(".filter-btn");
                const menuItems = document.querySelectorAll(".menu-item");

                filterButtons.forEach(button => {
                    button.addEventListener("click", function() {
                        const category = button.getAttribute("data-category");
                        menuItems.forEach(item => {
                            if (category === "all" || item.getAttribute("data-category") === category) {
                                item.style.display = "block";
                            } else {
                                item.style.display = "none";
                            }
                        });
                    });
                });
            });
            const filterButtons = document.querySelectorAll('.filter-btn');

                filterButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        filterButtons.forEach(btn => {
                        btn.classList.remove('active');
                        });
                    button.classList.add('active');
                    });
                });
        </script>

        <script>
            AOS.init();
        </script>
</body>

</html>