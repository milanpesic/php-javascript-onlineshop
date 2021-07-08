<?php include('layout/header.php');  ?>

<?php if(!empty($cart->allProducts()) /*&& Session::has('user')*/) : ?>

<div class="row w-100 justify-content-center" style="font-size: 18px;">

    <div class="col-md-10 mt-5 mb-5">

    <h1 class="mb-5 alert alert-secondary font-weight-bold">Shopping Cart</h1>

        <div class="table-responsive">

            <table class="table border" style="border-width:3px!important;">
            <thead class="thead-secondary">
                <tr>
                <th class="text-center p-3">#</th>
                <th class="text-center p-3">Product</th>
                <th class="text-center p-3">Price</th>
                <th class="text-center p-3">Quantity</th>
                <th class="text-center p-3">Total</th>
                <th class="text-center p-3">Remove</th>
                </tr>
            </thead>

            <?php foreach($cart->allProducts() as $product) : ?>

                <tbody>
                    <tr>
                    <td class="text-center align-middle p-3"><a href="<?php echo $config['url']['path'] . 'product/' . $product->slug; ?>" target="_blank"><img src="<?php echo $product->image; ?>" class="img-fluid img-thumbnail" alt="" style="width: 80px; height: 60px;" ></a></td>
                    <td class="text-center align-middle p-3"><a href="<?php echo $config['url']['path'] . 'product/' . $product->slug; ?>" target="_blank"><?php echo substr($product->productName, 0, 30) . '...'; ?></a></td>
                    <td class="text-center align-middle font-weight-bold p-3" style="width: 160px;"><?php echo '&euro; ' . $product->price; ?></td>
                    <td class="align-middle text-center p-3">
                        
                    <!--  
                        <form action="<?php //echo $config['url']['path'] . 'cart/update/' . $product->slug; ?>" method="POST" class="form-inline justify-content-center">
                            <input type="number" min="1" max="10" name="quantity" class="text-center form-control form-control-sm col-4 ml-2" value="<?php echo $product->quantity; ?>">
                            <input type="submit" class="btn btn-sm btn-outline-danger ml-2" value="Update">   
                        </form>
                    -->

                    <span class="p-3 btn-group">
                        <input class="btn btn-light border shadow-none" type="button" onclick="decrementQuantity(<?php echo $product->productID; ?>);" value="-" style="border-width: 3px !important;">
                        <input class="btn btn-light border shadow-none" type="number" id="quantity-<?php echo $product->productID; ?>" class="text-center" min="1" max="10" value="<?php echo $product->quantity; ?>" readonly style="border-top-width: 3px !important; border-bottom-width: 3px !important;">
                        <input class="btn btn-light border shadow-none" type="button" onclick="incrementQuantity(<?php echo $product->productID; ?>);" value="+" style="border-width: 3px !important;">
                    </span>
                        
                    </td>
                    <td class="text-center align-middle font-weight-bold p-3" style="width: 160px;"><?php echo '&euro; ' . number_format($product->price * $product->quantity, 2); ?></td>
                    <td class="text-center align-middle p-3"><a class="badge badge-secondary" href="<?php echo $config['url']['path'] . 'cart/remove/' . $product->productID; ?>">Remove</a></td></tr>
                </tbody>

            
            <?php endforeach; ?>

                <a class="badge badge-dark" style="font-size: 16px;" href="<?php echo $config['url']['path'] . 'cart/clear'; ?>">Clear Cart</a></td>

                <tbody>
                    <tr>
                        <th class="text-center align-middle p-3">SubTotal</th><td></td><td></td><td></td><td class="text-center align-middle font-weight-bold"><span><?php echo '&euro; ' . number_format($cart->subTotal(), 2); ?></span></td><td></td>
                    </tr>
                    <tr>
                        <th class="text-center align-middle p-3">Tax</th><td></td><td></td><td></td><td class="text-center align-middle font-weight-bold">&euro; 25.00</td><td></td>
                    </tr>
                    <tr>
                        <th class="text-center align-middle p-3">Total</th><td></td><td></td><td></td><td class="text-center align-middle font-weight-bold"><span class="badge text-success font-weight-bold" style="font-size: 20px;"><?php echo '&euro; ' . number_format($cart->subTotal() + 25, 2); ?></span></td><td></td>
                    </tr>
                    <tr>
                        <th class="text-center align-middle p-3"><a class="btn btn-secondary shadow-none text-left" href="<?php echo $config['url']['path'] . 'customer-details'; ?>">Continue</a></th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</div>

<?php else : ?>

    <div class="container text-center jumbotron bg-light mt-5">

        <span class="font-weight-bold btn" style="background: black; color: white;">Your shopping cart is empty!</span>

        <div style="font-size: 150px; color: lightgrey;">
        
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
            </svg>
        
        </div>

    </div>

<?php endif ?>

<?php include('layout/footer.php'); ?>