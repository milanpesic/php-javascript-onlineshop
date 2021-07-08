
<?php include('layout/header.php');  ?>

    <?php if(Session::has('reset-password')) : ?>

        <div class="container col-md-9 border-left border-success font-weight-bold mt-5 p-3 bg-light rounded-lg" style="border-width: 5px!important;">

           <?php echo Session::get('reset-password'); ?>

        </div>

    <?php endif; ?>

    <div class="row justify-content-center mt-5 mb-5">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header bg-dark text-muted">Your new password</div>

                <form action="<?php echo $config['url']['path'] . 'reset-password/' . $csrf_token; ?>" method="POST" class="p-5">

                    <div class="form-group">

                        <label for="password">New password</label>

                        <input type="password" name="password" class="form-control">

                        <div>
                            <p>
                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('password') : false; ?></small>
                            </p>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="repeat">Repeat password</label>

                        <input type="password" name="repeat" class="form-control">

                        <div>
                            <p>
                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('repeat') : false; ?></small>
                            </p>
                        </div>

                    </div>

                    <input type="hidden" name="csrf_token" value="<?php echo Token::generated('csrf_token'); ?>">

                    <button type="submit" class="btn btn-dark">Create</button>
                    
                </form>

            </div>

        </div>

    </div>

    <?php include('layout/footer.php'); ?>