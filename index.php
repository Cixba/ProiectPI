<?php
    require_once("db/connection.php");

    if(isset($_POST['logout']))
    {
        unset($_COOKIE['token']);
        setcookie('token', '', time() - 3600, '/');
        header("Location: index.php");
    }

    if(!$_COOKIE['token'])
        header("Location: ./login.php");
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proiect PI</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <form method="POST">
        <div class="offcanvas-menu-wrapper">
            <div class="canvas-close">
                <i class="icon_close"></i>
            </div>
            
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li><a href="./index.php">Acasa</a></li>
                    <li><a href="./about-us.html">Despre noi</a></li>

                    <?php 
                        if(!isset($_COOKIE['token']))
                        {
                    ?>
                    <li><a href="./login.php">Conectare</a></li>
                    <?php } else { 
                        $token = $_COOKIE['token'];
                        $query = "SELECT * FROM users WHERE token='$token'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        
                        if($row['type'] === 'admin')
                        {
                        ?>
                        <li><a href="./dashboard.php">Cont</a></li>
                    <?php } else { ?>
                        <li><a href="./index.php">
                            <button style="background: none; border: none; cursor: pointer;padding: 0; margin: 0;" name="logout">Deautentificare</button>
                        </a></li>
                    <?php } 
                        }
                    ?>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </form>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <form method="POST">
        <header class="header-section header-normal">
            <div class="menu-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="./index.php">
                                    <!-- <img src="img/logo.png" alt=""> -->
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
                                    <ul>
                                        <li class="active"><a href="./index.html">Acasa</a></li>
                                        <li><a href="./about-us.html">Despre noi</a></li>

                                        <?php 
                                            if(!isset($_COOKIE['token']))
                                            {
                                        ?>
                                        <li><a href="./login.php">Conectare</a></li>
                                        <?php } else { 
                                            $token = $_COOKIE['token'];
                                            $query = "SELECT * FROM users WHERE token='$token'";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            
                                            if($row['type'] === 'admin')
                                            {
                                            ?>
                                            <li><a href="./dashboard.php">Cont</a></li>
                                        <?php } else { ?>
                                            <li><a href="./index.php">
                                                <button style="background: none; border: none; cursor: pointer;padding: 0; margin: 0;" name="logout">Deautentificare</button>
                                            </a></li>
                                        <?php } 
                                            }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </form>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Destinatii</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <?php
                    $query = "select * from locatii";
                    $result = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="upload/<?php echo $row['id'];?>_0.png" alt="">
                        <div class="ri-text">
                            <h4><?php echo $row['titlu']; ?></h4>
                            <h3><?php echo $row['pret'];?>$<span>/pe noapte</span></h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Locatie:</td>
                                        <td><?php echo $row['locatie']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="r-o">Suprafata:</td>
                                        <td><?php echo $row['suprafata']; ?> m<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacitate:</td>
                                        <td><?php echo $row['capacitate']; ?> persoane</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Servicii:</td>
                                        <td><?php echo $row['servicii'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="./detalii_destinatie.php?id=<?php echo $row['id'];?>" class="primary-btn">Detalii</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>