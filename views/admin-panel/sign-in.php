
<?php $config = Config::instance(); ?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Document</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <style>
        
            body {

                font-family: "Trebuchet MS", Helvetica, sans-serif;
                
            }

            .active:hover {
                color: gold!important;
               
            }

            .active:focus {
                color: gold!important;
               
            }

        </style>

    </head>

    <body class="shadow">

    <?php if(Session::has('admin-warning')) : ?>

      <div class="container alert alert-warning mt-5" role="alert">

          <?php echo Session::get('admin-warning'); ?>

      </div>

    <?php endif; ?>

    <div class="container">

      <div class="row justify-content-aroundcenter" style="margin-top: 90px">

      <div class="col"><img src="<?php echo $config['url']['path'] . 'public/images/admin-panel.png'; ?>" class="img-fluid" width="600" height="300" alt=""></div>

        <div class="col-4 mt-5 mr-5">

            <form action="<?php echo $config['url']['path'] . 'admin-panel/sign-in'; ?>" method="POST">

              <div class="form-group">

                <input type="username" name="username" class="form-control border-0 shadow-none rounded-0" value="<?php echo 'admin'; ?>" placeholder="Username" style="background: black; color: white;">

                  <div>
                      <p>
                          <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('username') : false; ?></small>
                      </p>
                  </div>

              </div>

              <div class="form-group">

                <input type="password" name="password" class="form-control border-0 shadow-none rounded-0" value="<?php echo 'admin'; ?>" placeholder="Password" style="background: black; color: white;">

                <div>
                      <p>
                        <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('password') : false; ?></small>
                      </p>
                </div>

              </div>

              <input type="hidden" name="csrf_token" value="<?php echo Token::generated('csrf_token'); ?>">

              <hr>

              <button class="btn btn-primary rounded-0 shadow-none" type="submit">Sign In</button>

            </form>

        </div>

      </div>

    </div>

  </body>

</html>