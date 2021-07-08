<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col">

    <div class="container border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        <div class="row">

            <div class="col-md-auto">Products</div>

                <form action="<?php echo $config['url']['path'] . 'admin-panel/products-search-result'; ?>" class="col-md-5 input-group ml-5" method="post">

                    <input id="productName" type="text" class="form-control form-control-sm shadow-none" name="productName">

                    <div class="input-group-append">

                        <input type="submit" class="btn btn-dark btn-sm shadow-none" id="search" onclick="return enableSearch()" value="Search">

                    </div>

                </form>

            </div>

        </div>


    <div class="table-responsive badge">

        <h3 class="font-weight-bold text-center mt-3">Search Result for '<?php echo !empty($_POST['productName']) ? trim($_POST['productName']) : ''; ?>'</h3>

            <hr>

            <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

            <thead class="thead-dark">

                <tr>
                <th class="p-2">Image</th>
                <th class="p-2">Product</th>
                <th class="p-2">Price</th>
                <th class="p-2">Price Discount</th>
                <th class="p-2">Stock</th>
                <th class="p-2">Category</th>
                <th class="p-2">SubCategory</th>
                <th class="p-2">Edit</th>
                <th class="p-2">Delete</th>
                </tr>
            </thead>

            <tbody>

        <?php if(!empty($products)) : ?>

        <?php foreach($products as $product) : ?>

            <tr>
            <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/product-preview/' . $product->productID; ?>" target="_blank"><img src="<?php echo $product->image; ?>" class="img-fluid" alt="image is not added yet" style="width: 60px; height: 50px;"></a></td>
            <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/product-preview/' . $product->productID; ?>" target="_blank"><?php echo substr($product->productName, 0, 30) . '...'; ?></a></td>
            <td class="align-middle"><?php echo $product->price; ?></td>
            <td class="align-middle"><?php echo !empty($product->priceDiscount) ? $product->priceDiscount : '<span class="btn btn-sm bg-danger">N/A</span>'; ?></td>
            <td class="align-middle"><?php echo !empty($product->stock) ? $product->stock : 0; ?></td>

            <td class="align-middle"><?php echo DB::find('categories', ['categoryID' => $product->categoryID])->categoryName; ?></td>
            <td class="align-middle"><?php echo !empty(DB::find('subcategories', ['subcategoryID' => $product->subcategoryID])->subcategoryName) ? DB::find('subcategories', ['subcategoryID' => $product->subcategoryID])->subcategoryName : '<span class="btn btn-sm bg-danger">N/A</span>'; ?></td>
            <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/product-edit/' . $product->productID; ?>" target="_blank" class="btn btn-sm btn-warning shadow-none">Edit</a></td>
            <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/product-delete/' . $product->productID; ?>" class="btn btn-sm btn-danger shadow-none" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
            </tr>

        <?php endforeach; ?>

        <?php else : ?>

            <tr>
            <td colspan="9" class="p-5">
                There are no products in your database. 
                
                <?php if(empty(DB::find('categories'))) : ?>
                
                    You should first create categories and subcategories.

                <?php endif; ?>
            </td>
            </tr>

        <?php endif; ?>

        </tbody>

        </table>

        </div>
        
    </div>

</div>

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>