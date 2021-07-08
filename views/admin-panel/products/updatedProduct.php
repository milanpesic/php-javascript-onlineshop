<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        Product Preview

    </div>

    <div class="container">

        <div class="row mt-3 mb-3">

            <div class="col-md-6"><img src="<?php echo $updatedProduct->image; ?>" class="img-fluid img-thumbnail" alt="..." ></div>

            <div class="col-md-6">

                <div class="badge badge-success mb-3 card-text"><?php echo $updatedProduct->stock >= 5 ? 'In stock' : '';  ?></div>

                <div class="badge badge-warning mb-3 card-text"><?php echo $updatedProduct->stock < 5 && $updatedProduct->stock >= 1 ? 'Low stock' : ''; ?></div>

                <div class="badge badge-danger mb-3 card-text"><?php echo empty($updatedProduct->stock) ? 'Out of stock' : ''; ?></div>
            
                <p class="font-weight-bold"><?php echo $updatedProduct->productName; ?></p>

                <p class="font-weight-bold">
                
                    <?php echo !empty($updatedProduct->priceDiscount) ? '<del class="text-danger">' . '<span class="text-dark"> &euro; ' . number_format($updatedProduct->price, 2) . '</span></del>'  : ' &euro; ' . number_format($updatedProduct->price, 2); ?>

                </p>

                <?php if(!empty($updatedProduct->priceDiscount)) : ?>

                    <p class="font-weight-bold badge badge-danger mb-5" style="font-size: 18px;"><?php echo '&euro; ' . number_format($updatedProduct->priceDiscount, 2); ?></p>

                <?php endif; ?>

                <p><a href="<?php echo $config['url']['path'] . 'admin-panel/product-edit/' . $updatedProduct->productID; ?>" class="btn btn-sm btn-warning shadow-none">Edit</a>
            |
                <a href="<?php echo $config['url']['path'] . 'admin-panel/product-delete/' . $updatedProduct->productID; ?>" class="btn btn-sm btn-danger shadow-none" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
            |
                <a href="<?php echo $config['url']['path'] . 'admin-panel/products-show/'; ?>" class="btn btn-sm btn-primary shadow-none">Save</a>
                
                </p>

            </div>

            <div class="col-auto mt-5" style="font-size: 14px;">

                <h5 class="font-weight-bold">Description</h5>
            
                <?php echo $updatedProduct->description; ?>
            
            </div>

        </div>

    </div>

</div>

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>