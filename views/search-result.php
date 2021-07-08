
<?php include('layout/header.php');  ?>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-10 mt-5">
        
            <h3 class="font-weight-bold text-center">Search Result for '<?php echo !empty($_POST['productName']) ? trim($_POST['productName']) : ''; ?>'</h3>

            <hr>
            
        <?php if(!empty($products)) : ?>

            <div class="col-md-auto mt-5 mb-5">

                <div class="card-deck justify-content-center">

                    <?php foreach($products as $product) : ?>

                        <div class="">

                            <div class="card shadow mt-4" style="width: 14em;">

                                <div class="embed-responsive embed-responsive-16by9">

                                    <img src="<?php echo $product->image; ?>" class="card-img-top embed-responsive-item" alt="">

                                </div>

                                <div class="card-body">

                                    <p class="card-title small"><?php echo substr($product->productName, 0, 50) . '...'; ?></p>

                                    <p class="d-flex justify-content-between"><span class="badge badge-light text-left" style="font-size: 14px; font-weight: bold;"><?php echo !empty($product->priceDiscount) ? '<del class="text-danger">' . '<span class="text-dark"> &euro; ' . number_format($product->price, 2) . '</span></del>'  : ' &euro; ' . $product->price; ?></span>
                                            
                                    <?php if(!empty($product->priceDiscount)) : ?>

                                        <span class="badge badge-warning text-right" style="font-size: 14px; font-weight: bold;"><?php echo ' &euro; ' . number_format($product->priceDiscount, 2); ?></span>

                                    <?php endif; ?>

                                    </p>

                                    <hr/>

                                    <a href="<?php echo $config['url']['path'] . 'product' . '/' . $product->slug; ?>" class="btn btn-dark btn-block">Details</a>

                                </div>

                                <div class="card-footer">

                                    <small class="text-muted">*10% additional discount</small>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>
                    
                </div>
            
            </div>

        <?php else : ?>

            <div class="row justify-content-center">

                <div class="text-muted mt-5 col-md-auto">
                
                    <div><?php echo 'Nothing found'; ?></div>

                    <div><?php echo 'Try inserting different word...'; ?></div>
                
                </div>

            </div>

        <?php endif; ?>

        </div>

    </div>

</div>

<?php include('layout/footer.php'); ?>