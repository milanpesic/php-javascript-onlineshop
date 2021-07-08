    
    <?php include('layout/header.php');  ?>

    <form action="<?php echo $config['url']['path'] . 'order'; ?>" method="post">

        <div class="text-center mt-5 mb-5">

            <h1 class="font-weight-bold text-muted">Welcome to Order Page</h1>
            <hr>

        </div>  

        <div class="row w-100 mt-5 mb-5 d-flex justify-content-center">

            <?php if(!Session::has('user')) : ?>

            <div class="col-md-5 jumbotron"> 

                 <h3 class="font-weight-bold mb-5">Customer Details</h3>
        
                <div class="form-group">
                    
                    <label for="name">Name</label>

                    <input type="text" class="form-control form-control-sm" name="name" value="<?php echo !empty($_POST['name']) ? $_POST['name'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('name') : false; ?></small>
                        </p>
                    </div>
                    
                </div>

                <div class="form-group">
                    
                    <label for="email">Email</label>

                    <input type="email" class="form-control form-control-sm" name="email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('email') : false; ?></small>
                        </p>
                    </div>
                    
                </div>
                    
            </div>

            <?php endif; ?>

            <div class="col-md-5 ml-3 jumbotron"> 

                <h3 class="font-weight-bold mb-5"> Shipping Details</h3>

                <div class="form-group">
                    
                    <label for="phone">Phone</label>

                    <input type="text" class="form-control form-control-sm" name="phone" value="<?php echo !empty($_POST['phone']) ? $_POST['phone'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('phone') : false; ?></small>
                        </p>
                    </div>
                    
                </div>

                <div class="form-group">
                    
                    <label for="address">Address</label>

                    <input type="text" class="form-control form-control-sm" name="address" value="<?php echo !empty($_POST['address']) ? $_POST['address'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('address') : false; ?></small>
                        </p>
                    </div>
                    
                </div>

                <div class="form-group">
                    
                    <label for="city">City</label>

                    <input type="text" class="form-control form-control-sm" name="city" value="<?php echo !empty($_POST['city']) ? $_POST['city'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('city') : false; ?></small>
                        </p>
                    </div>
                    
                </div>

                <div class="form-group">
                    
                    <label for="postal">Postal</label>

                    <input type="text" class="form-control form-control-sm" name="postal" max="5" value="<?php echo !empty($_POST['postal']) ? $_POST['postal'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('postal') : false; ?></small>
                        </p>
                    </div>
                    
                </div>

                <div class="form-group">
                    
                    <label for="country">Country</label>

                    <input type="text" class="form-control form-control-sm" name="country" value="<?php echo !empty($_POST['country']) ? $_POST['country'] : ''; ?>">

                    <div>
                        <p>
                            <small class="text-danger"><?php echo !empty($errors) ? $errors->oneError('country') : false; ?></small>
                        </p>
                    </div>
                    
                </div>

            </div>

            <div class="col-auto ml-3 jumbotron">

            <h3 class="font-weight-bold mb-5"> Order Details</h3>
            
                <div class="table-responsive-sm">

                    <table class="table">

                        <tbody>

                            <?php foreach($cart->allProducts() as $product) : ?>   

                                <tr>
                                    <th><a href="<?php echo $config['url']['path'] . 'product/' . $product->slug; ?>" target="_blank"><?php echo substr($product->productName, 0, 50) . '...'; ?></a></th><td class="text-center"><?php echo $product->quantity; ?></td>
                                </tr>

                            <?php endforeach; ?>

                            <tr>
                                <th>SubTotal</th><td class="text-center"><span><?php echo '&euro; ' . number_format($cart->subTotal(), 2); ?></span></td>
                            </tr>

                            <tr>
                                <th>Tax</th><td class="text-center">&euro; 25.00</td>
                            </tr>

                            <tr>
                                <th>Total</th><td class="text-center"><span class="badge badge-success" style="font-size: 16px;"><?php echo '&euro; ' . number_format($cart->subTotal() + 25, 2); ?></span></td>
                            </tr>

                        </tbody>

                    </table>

                    <input type="hidden" name="csrf_token" value="<?php echo Token::generated('csrf_token'); ?>">

                    <hr>

                    <input type="submit" name="submit" class="btn btn-sm shadow-none btn-dark" value="Order">

                </div>
            
            </div>

        </div>

    </form>

    <?php include('layout/footer.php'); ?>