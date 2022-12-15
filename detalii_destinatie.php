<?php
    require_once("db/connection.php");

    if(!$_GET['id'])
        header("Location: ./index.php");

    $id = $_GET['id'];

    $query = "SELECT * FROM locatii WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['logout']))
    {
        unset($_COOKIE['token']);
        setcookie('token', '', time() - 3600, '/');
        header("Location: index.php");
    }

    $token = $_COOKIE['token'];
    $query_user = "select * from users where token='$token'";
    $result_user = mysqli_query($conn, $query_user);
    $row_user = mysqli_fetch_assoc($result_user);

    if(isset($_POST['sterge']))
    {
        $query_sterge = "DELETE FROM locatii where id='$id'";
        mysqli_query($conn, $query_sterge);
        header("Location: ./index.php");
    }
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
                        $row2 = mysqli_fetch_assoc($result);
                        
                        if($row2['type'] === 'admin')
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
                                <a href="./index.html">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
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
                                            $row2 = mysqli_fetch_assoc($result);
                                            
                                            if($row2['type'] === 'admin')
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="upload/<?php echo $row['id'];?>_0.png" alt="">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3><?php echo $row['titlu'];?></h3>
                            </div>
                            <h2><?php echo $row['pret'];?>$<span>/pe noapte</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Suprafata:</td>
                                        <td><?php echo $row['suprafata'];?> m<sup>2</sup></td>
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
                        </div>

                        <form method="POST">
                            <?php if($row_user['id'] == $row['id_creator']) 
                            { ?>
                                <button class="btn btn-danger" name="sterge">Sterge</button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <form action="#">
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="guest">Numar persoane:</label>
                                <select id="guest">
                                    <?php
                                    for($i = 1;$i <= $row['capacitate'];$i++)
                                    {
                                    ?>
                                    <option value=""><?php echo $i;?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button type="submit">Verifica disponibilitatea</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->

    <!-- Footer Section Begin -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

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