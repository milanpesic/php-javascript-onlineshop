
<?php $config = Config::instance(); ?>

<?php $cart = new CartController; ?>

<!DOCTYPE html>

    <html lang="en">

        <head>

            <meta charset="UTF-8">

            <meta name="description" content="Welcome to Online Shop">

            <meta name="author" content="Milan Pesic"> 

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Online Shop</title>

            <link rel="stylesheet" href="<?php echo $config['url']['path'] . 'public/bootstrap.min.css'; ?>"> 

            <link rel="stylesheet" href="<?php echo $config['url']['path'] . 'public/style.css'; ?>">

            <link rel="stylesheet" href="<?php echo $config['url']['path'] . 'public/font-awesome.min.css'; ?>">


        </head>


<style>

.pagination {

   margin: 0;

}

.actives {

    background-color: #666;
    color: white;

}

.active-hover:hover {

    background-color: lightgrey!important;

}

.activeItem:hover {

    background: white!important;

    color: black!important;

/*
    background: grey!important;

    color: white!important;

*/

}

.hoverLInk:hover {

    background: lightgrey!important;

    color: black!important;

}

.dropdown-menu {

    
    margin: 0 !important;
   
}


.activeLink {

    background: lightgrey!important;

    color: black!important;

}

.card-img-top {

    width: 100%;

}

</style>

    <body class="bg-light">

        <div>

            <?php include('navbar.php'); ?>