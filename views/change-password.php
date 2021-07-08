
<?php include('layout/header.php');  ?>

<div class="container">

<div class="row justify-content-center mt-5 mb-5">

    <div class="col-md-4">

        <form action="<?php echo $config['url']['path'] . 'change-password'; ?>" method="POST" >

            <div class="form-group">

                    <label for="password">Current Password</label>

                    <input type="password" class="form-control" name="password" id="password">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('password') : false; ?></small>
                        </p>
                    </div>

            </div>

            <div class="form-group">

                    <label for="newPassword">New Password</label>

                    <input type="password" class="form-control" name="newPassword" id="newPassword">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('password') : false; ?></small>
                        </p>
                    </div>

            </div>

            <div class="form-group">

                    <label for="newPasswordRepeat">New Password Repeat</label>

                    <input type="password" class="form-control" name="newPasswordRepeat" id="newPasswordRepeat">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('password') : false; ?></small>
                        </p>
                    </div>

            </div>

                <input type="hidden" name="csrf_token" value="<?= Token::generated('csrf_token'); ?>">

                <input type="submit" class="btn btn-dark" value="Change">
            
        </form>

    </div>

</div>

</div>

<?php include('layout/footer.php'); ?>