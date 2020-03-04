<?php
include_once('auth.php');
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>भान्साघर</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Styles -->
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">

    <style>

    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div class="logo-wrapper">

                        <img src="/assets/image/logo.png" class="img img-fluid" alt="" srcset="">
                        <div>
                            <p>Bhansaghar</p>
                            <p class='small'>Authentic Nepali Kitchen</p>
                        </div>

                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if ($login == false) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register.php">Register</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item mx-2">
                                <?php include('cart-button.php') ?>
                            </li>
                            <?php include_once('profile.php'); ?>
                        <?php endif; ?>



                    </ul>
                </div>
            </div>
        </nav>
<?php 
//if there is content in $_SESSION['message'], show and set it to null.. thus enabling one time display of messages

?>
        <main class="py-4" style='min-height:80vh'>
                <?php if (isset($_SESSION['message'])) : ?>
            <div class="container">

                    <div class="alert alert-primary">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php
                    $_SESSION['message'] = null;
                    ?>
                                </div>

                <?php endif; ?>
                
