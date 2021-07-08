
<?php include('layout/header.php');  ?>

    <?php if(Session::has('update')) : ?>

        <div class="container alert alert-success d-flex justify-content-center mt-5" role="alert">

            <?php echo Session::get('update'); ?>

        </div>

    <?php endif; ?>

    <?php if(Session::has('notUpdated')) : ?>

        <div class="container alert alert-danger d-flex justify-content-center mt-5" role="alert">

            <?php echo Session::get('notUpdated'); ?>

        </div>

    <?php endif; ?>

    <div class="container mt-5">

        <div class="row d-flex justify-content-center mt-5 mb-5">

            <div class="col-md-10">

                <div class="row d-flex justify-content-center mt-5 mb-5">
                
                    <div class="col-md-10">
                    
                        <div class="text-center">
                            
                            <h1>Update your profile</h1>

                            <small>Here you can change and update your profile name and password</small>
                        
                        </div>

                    </div>
                
                </div>

            </div>

            <div class="col-md-5">

            <div class="border shadow p-3 mb-3">

                <?php echo 'Username: ' . $user->username . '</br>'; ?>

                    <?php echo 'Name: ' . $user->name . '</br>'; ?>

                    <?php echo 'Email: ' . $user->email . '</br>'; ?>

            </div>

            <form action="<?php echo $config['url']['path'] . 'update-profile'; ?>" method="POST">

                <div class="form-group mb-4">

                        <label for="username">Update Username</label>

                        <input type="text" class="form-control" name="username" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : ''; ?>" placeholder="<?php echo !empty($current->username) ? $current->username : ''; ?>">

                        <div>
                            <p>
                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('username') : false; ?></small>
                            </p>
                        </div>

                    </div>

                    <div class="form-group mb-4">

                        <label for="name">Update Name</label>

                        <input type="text" class="form-control" name="name" value="<?php echo !empty($_POST['name']) ? $_POST['name'] : ''; ?>" placeholder="<?php echo !empty($current->name) ? $current->name : ''; ?>">

                        <div>
                            <p>
                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('name') : false; ?></small>
                            </p>
                        </div>

                    </div>

            </div>

                <div class="col-md-4">

                    <div class="form-group mb-4">

                        <label for="password">Current Password</label>

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

                    <div class="form-group mb-4">

                        <label for="newPassword">New Password</label>

                            <div class="input-group mb-2">
        
                                <input type="password" class="form-control" name="newPassword" id="newPassword"  value="<?php echo !empty($_POST['newPassword']) ? $_POST['newPassword'] : ''; ?>">
        
                                <div class="input-group-append">
       
                                    <button class="btn btn-light border shadow-none d-flex align-items-center" onclick="showHidePassword1()" type="button">
       
                                        <svg id="closeEye1" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/>
                                            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                        </svg>

                                        <svg id="openEye1" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>

                                    </button>

                                </div>
      
                            </div>


                        <div>
                            <p>
                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('newPassword') : false; ?></small>
                            </p>
                        </div>

                    </div>

                    <div class="form-group mb-4">

                        <label for="repeatPassword">New Password Repeat</label>

                        <div class="input-group mb-2">
        
                            <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" value="<?php echo !empty($_POST['repeatPassword']) ? $_POST['repeatPassword'] : ''; ?>">
        
                                <div class="input-group-append">
       
                                    <button class="btn btn-light border shadow-none d-flex align-items-center" onclick="showHidePassword2()" type="button">
       
                                        <svg id="closeEye2" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/>
                                            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                        </svg>

                                        <svg id="openEye2" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>

                                    </button>

                                </div>
      
                        </div>

                        <div>
                            <p>
                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('repeatPassword') : false; ?></small>
                            </p>
                        </div>

                    </div>

                    <input type="hidden" name="csrf_token" value="<?= Token::generated('csrf_token'); ?>">

                    <input type="submit" class="btn btn-dark" value="Update">
                
                </div>

            </form>

        </div>

    </div>

<?php include('layout/footer.php'); ?>