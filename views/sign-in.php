
<?php include('layout/header.php');  ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <?php if(Session::has('success')) : ?>

                    <div class="container col-md-6 alert alert-success d-flex justify-content-center mt-5" role="alert">

                        <?php echo Session::get('success'); ?>

                    </div>

                <?php endif; ?>

                <?php if(Session::has('warning')) : ?>

                    <div class="container col-md-6 alert alert-warning d-flex justify-content-center mt-5" role="alert">

                        <?php echo Session::get('warning'); ?>

                    </div>

                <?php endif; ?>

                <?php if(Session::has('reset-password')) : ?>

                    <div class="container col-md-6 alert alert-info d-flex justify-content-center mt-5" role="alert">

                        <?php echo Session::get('reset-password'); ?>

                    </div>

                <?php endif; ?>

                <?php if(Session::has('accountNotActivated')) : ?>

                    <div class="container col-md-6 alert alert-primary d-flex justify-content-center mt-5" role="alert">

                        <?php echo Session::get('accountNotActivated'); ?>

                    </div>

                <?php endif; ?>

                <div class="text-center mt-5">

                    <h1 class="font-weight-bold">Sign In</h1>

                </div>
            
                <div class="row d-flex justify-content-center mt-5 mb-5">
               
                    <div class="col-md-5">

                        <form action="<?php echo $config['url']['path'] . 'sign-in'; ?>" method="POST">

                            <div class="form-group">

                                    <label for="username">Username/email</label>

                                    <input type="text" class="form-control" name="username" id="username">

                                    <div>
                                        <p>
                                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('username') : false; ?></small>
                                        </p>
                                    </div>

                            </div>

                            <div class="form-group">

                                    <label for="password">Password</label>

                                    <div class="input-group mb-2">
        
                                        <input type="password" class="form-control" name="password" id="password" value="<?php echo !empty($_POST['password']) ? $_POST['password'] : ''; ?>">
                
                                        <div class="input-group-append">
            
                                            <button class="btn btn-light border shadow-none d-flex align-items-center" onclick="showHidePassword()" type="button">
            
                                                <svg id="closeEye" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/>
                                                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                </svg>

                                                <svg id="openEye" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>

                                            </button>

                                        </div>
      
                                    </div>

                                    <div>
                                        <p>
                                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('password') : false; ?></small>
                                        </p>
                                    </div>

                            </div>

                            <div class="form-group form-check">

                                <input type="checkbox" name="remember" class="form-check-input">

                                <label class="form-check-label" for="remember">Remember me</label>

                            </div>

                                <input type="hidden" name="csrf_token" value="<?= Token::generated('csrf_token'); ?>">

                                <input type="hidden" name="cookie_token" value="<?= Token::generated('cookie_token'); ?>">

                                <input type="submit" class="btn btn-dark btn-block" value="Sign In">

                                <hr/>

                                <small><a href="<?php echo $config['url']['path'] . 'send-reset-link'; ?>">Forgotten password?</a></small>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php include('layout/footer.php'); ?>