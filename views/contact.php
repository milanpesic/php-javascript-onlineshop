
<?php include('layout/header.php'); ?>

<div class="container-fluid">

    <div class="row d-flex justify-content-center" style="margin-top: 90px;">

        <div class="col-md-12">

            <div class="text-center">

                <h1 class="font-weight-bold">Contact Us</h1>

                <small>Here you can contact our staff, and you'll get response in a while.</small>

            </div>

            <div class="row mt-5 d-flex justify-content-center mb-5">

                <div class="col-md-5 mt-5">

                    <?php if(Session::has('contact-success')) : ?>

                        <div class="container alert alert-success mb-5">

                            <?php  echo Session::get('contact-success'); ?>

                        </div>

                    <?php endif; ?>

                        <form action="<?php echo $config['url']['path'] . 'contact'; ?>" method="POST">

                                    <div class="form-group mb-5">
                                      
                                        <input type="text" class="form-control shadow-none" name="name" id="name" style="border: 0; outline: 0; border-bottom: 1px solid black; border-radius: 0; border-width: 2px !important;" placeholder="Name" value="<?php echo !empty($_POST['name']) ? $_POST['name'] : ''; ?>">
  
                                        <div>
                                            <p>
                                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('name') : false; ?></small>
                                            </p>
                                        </div>

                                    </div>

                                    <div class="form-group mb-5">
                                      
                                        <input type="email" class="form-control shadow-none" name="email" id="email" style="border: 0; outline: 0; border-bottom: 1px solid black; border-radius: 0; border-width: 2px !important;" placeholder="Email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ''; ?>">

                                        <div>
                                            <p>
                                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('email') : false; ?></small>
                                            </p>
                                        </div>
                                    </div>
                                            
                                    <div class="form-group">
                                      
                                        <textarea name="text" class="form-control shadow-none" id="text" cols="30" rows="10" style="border: 0; outline: 0; border-bottom: 1px solid black; border-radius: 0; border-width: 2px !important;" placeholder="Enter your message"><?php echo !empty($_POST['text']) ? $_POST['text'] : ''; ?></textarea>

                                        <div>
                                            <p>
                                                <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('text') : false; ?></small>
                                            </p>
                                        </div>
                                    </div>
                                            
                                    <input type="hidden" name="csrf_token" value="<?= Token::generated('csrf_token'); ?>">

                                    <input type="submit" class="btn btn-dark brn-sm" value="Submit">
                                
                            </form>

                </div>

            </div>

        </div>

        <div class="col-md-5">
                
                <ul class="list-group mt-5">
                    <li class="list-group-item text-light font-weight-bold border-0 rounded-0 bg-dark p-1 mb-2">Company Info</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >Online Shop Ltd.</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >TIN. 123456789 </li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >RN. 98765432</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1 mb-5" >A/c. 250-123456789-12</li>

                    <li class="list-group-item text-light font-weight-bold border-0 rounded-0 bg-dark p-1 mb-2">Contact</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >+38116.123.456</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >+38160.123.4567</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1 mb-5" >info@onlineshop.com</li>
                    
                    <li class="list-group-item text-light font-weight-bold border-0 rounded-0 bg-dark p-1 mb-2">Address</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >St. Great Place 32</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >16000 Leskovac</li>
                    <li class="list-group-item border-0 text-muted text-left bg-light p-1" >Serbia</li>
                </ul>

            </div>
    </div>

</div>

    <?php include('layout/footer.php'); ?>