
<?php include('layout/header.php');  ?>

    <div class="container-fluid">

        <div class="row justify-content-around mt-5">
        
            <div class="col-md-11">

                <div class="row justify-content-around">

                    <div class="col-md-6 mt-5">

                        <img src="<?php echo $product->image; ?>" class="img-thumbnail" alt="..." width="500">

                    </div>

                    <div class="col-md-6 mt-5">

                            <div class="badge badge-success mb-3 card-text"><?php echo $product->stock >= 5 ? 'In stock' : '';  ?></div>

                            <div class="badge badge-warning mb-3 card-text"><?php echo $product->stock < 5 && $product->stock >= 1 ? 'Low stock' : ''; ?></div>

                            <div class="badge badge-danger mb-3 card-text"><?php echo $product->stock === 0 ? 'Out of stock' : ''; ?></div>


                            <h5 class="font-weight-bold"><?php echo $product->productName; ?></h5>

                            <p class="mt-5"><span class="badge badge-light" style="font-size: 20px; font-weight: bold;"><?php echo !empty($product->priceDiscount) ? '<del class="text-danger">' . '<span class="text-dark"> &euro; ' . number_format($product->price, 2) . '</span></del>'  : ' &euro; ' . number_format($product->price, 2); ?></span>
                                
                                <?php if(!empty($product->priceDiscount)) : ?>
            
                                    <div class="text-success" style="font-size: 26px; font-weight: bold;"><?php echo ' &euro; ' . number_format($product->priceDiscount, 2); ?></div>
            
                                <?php endif; ?>
        
                            </p>

                            <hr>

                            <form action="<?php echo $config['url']['path'] . 'cart/add'; ?>" method="POST">

                                <p style="font-size: 18px;">

                                    <span class="btn-group">
                                        <input class="btn btn-light border shadow-none" type="button" id="productMinus" value="-" style="border-width: 3px !important;">
                                        <input class="btn btn-light border shadow-none" type="number" id="productQuantity" class="text-center" name="quantity" min="1" max="10" value="1" readonly style="border-top-width: 3px !important; border-bottom-width: 3px !important;">
                                        <input class="btn btn-light border shadow-none" type="button" id="productPlus" value="+" style="border-width: 3px !important;">
                                    </span>
                                    <input type="hidden" name="productID" value="<?php echo $product->productID; ?>">
                                    <input type="submit" class="btn btn-dark shadow-none ml-3" value="Add to cart">

                                </p>
                                    
                            </form>

                    </div>   

                </div> 

                <div class="row">

                    <div class="col-md-auto mt-5 mb-5">

                        <h6 class="font-weight-bold adge">Description</h6>

                        <p class="text-dark" style="font-size: 14px;"><?php echo $product->description; ?></p>

                    </div>

                </div>
                    
            </div>

        </div>

    </div>

<?php include('layout/footer.php'); ?>