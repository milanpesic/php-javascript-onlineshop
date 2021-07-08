<?php $config = Config::instance(); ?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <style>
       
            html, body {

                font-family: "Tahoma";
                font-weight: bold !important;
                background: lightgrey;
                height: 100%;
                margin: 0;
                
            }

            a:hover {
                color: gold !important;
            }

            a:active {
                color: gold !important;
            }


            
        </style>

    </head>

    <body>


    <?php include('admin-navbar.php'); ?>

    