
<?php include('layout/header.php');  ?>

    <?php if(Session::has('send-reset-link')) : ?>

        <div class="container col-md-9 border-left border-success font-weight-bold mt-5 p-3 bg-light rounded-lg" style="border-width: 5px!important;">

           <?php echo Session::get('send-reset-link'); ?>

        </div>

    <?php endif; ?>

    <div class="container">

    <div class="row justify-content-center mt-5">After you enter your registration email, we'll send you a reset link, and then you should be able to reset your password. </div>

        <div class="row justify-content-center mt-5 mb-5 w-100">

            <div class="col-md-5">

                <div class="card">

                    <div class="card-header bg-dark text-muted">RESET LINK</div>

                    <form action="<?php echo $config['url']['path'] . 'send-reset-link'; ?>" method="POST" class="p-5">

                        <div class="form-group">

                            <input type="email" name="email" class="form-control" placeholder="Enter your email here">

                            <div>
                                <p>
                                    <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('email') : '<span class="form-text text-muted">We\'ll send you a link where you can reset your password.</span>'; ?></small>
                                </p>
                            </div>

                        </div>

                        <input type="hidden" name="csrf_token" value="<?php echo Token::generated('csrf_token') ?>">

                        <button type="submit" class="btn btn-dark">Send</button>
                        
                    </form>

                </div>

            </div>

        </div>

    </div>

    <?php include('layout/footer.php'); ?>