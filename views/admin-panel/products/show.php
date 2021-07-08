
   <?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

   <div class="col"> 
    
    <?php if(Session::has('newProduct')) : ?>
     
        <?php $newProduct = Session::get('newProduct'); ?>

        <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

            Product Preview

        </div>

    <div class="container">

        <div class="row mt-3 mb-3">

            <div class="col-md-6"><img src="<?php echo $newProduct->image; ?>" class="img-fluid img-thumbnail" alt="..." ></div>

            <div class="col-md-6">

                <div class="badge badge-success mb-3 card-text"><?php echo $newProduct->stock >= 5 ? 'In stock' : '';  ?></div>

                <div class="badge badge-warning mb-3 card-text"><?php echo $newProduct->stock < 5 && $newProduct->stock >= 1 ? 'Low stock' : ''; ?></div>

                <div class="badge badge-danger mb-3 card-text"><?php echo empty($newProduct->stock) ? 'Out of stock' : ''; ?></div>

                <p class="font-weight-bold"><?php echo $newProduct->productName; ?></p>


                <p class="font-weight-bold">
                
                  <?php echo !empty($newProduct->priceDiscount) ? '<del class="text-danger">' . '<span class="text-dark"> &euro; ' . number_format($newProduct->price, 2) . '</span></del>'  : ' &euro; ' . number_format($newProduct->price, 2); ?>

                </p>

                <?php if(!empty($newProduct->priceDiscount)) : ?>

                    <p class="font-weight-bold badge badge-danger mb-5" style="font-size: 18px;"><?php echo '&euro; ' . number_format($newProduct->priceDiscount, 2); ?></p>

                <?php endif; ?>

                <p><a href="<?php echo $config['url']['path'] . 'admin-panel/product-edit/' . $newProduct->productID; ?>" class="btn btn-sm btn-warning shadow-none">Edit</a>
            |
                <a href="<?php echo $config['url']['path'] . 'admin-panel/product-delete/' . $newProduct->productID; ?>" class="btn btn-sm btn-danger shadow-none" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
            |
                <a href="<?php echo $config['url']['path'] . 'admin-panel/products-show/'; ?>" class="btn btn-sm btn-primary shadow-none">Save</a></p>

            </div>

            <div class="col-auto mt-5" style="font-size: 14px;">

                <h5 class="font-weight-bold">Description</h5>
            
                <?php echo $newProduct->description; ?>
            
            </div>

        </div>

    </div>
          
        <?php else : ?>

          <div class="container border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

            <div class="row">

              <div class="col-md-auto align-self-center">Products <?php echo '(' . count($showProducts) . ')'; ?></div>

              <form action="<?php echo $config['url']['path'] . 'admin-panel/products-search-result'; ?>" class="col-md-5 input-group" method="post">

                  <input id="productName" type="text" class="form-control form-control-sm shadow-none" name="productName" required>

                  <div class="input-group-append">

                      <input type="submit" class="btn btn-dark btn-sm shadow-none" id="search" onclick="return enableSearch()" value="Search">

                  </div>

              </form>

              <div class="col-md-auto ml-md-auto">

              <?php if(!empty(DB::find('categories'))) : ?>

                  <a href="<?php echo $config['url']['path'] . 'admin-panel/product-create'; ?>" class="btn btn-sm btn-dark">Create New Product</a>
            
              <?php endif; ?>

              </div>

            </div> 

        </div>

        <?php if(Session::has('updateProduct')) : ?>
      
            <div class="container alert alert-success">
      
              <?php echo Session::get('updateProduct'); ?>
      
            </div>

        <?php endif; ?>

        <?php if(Session::has('createdProduct')) : ?>
          
          <div class="container alert alert-success">
          
            <?php echo Session::get('createdProduct'); ?>
          
          </div>

        <?php endif; ?>

        <?php if(Session::has('deletedProduct')) : ?>
          
          <div class="container alert alert-success">
          
            <?php echo Session::get('deletedProduct'); ?>
          
          </div>

        <?php endif; ?>


      <div class="table-responsive badge">

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

          <?php if(!empty($showProducts)) : ?>

          <?php foreach($showProducts as $product) : ?>

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
              <td colspan="8" class="p-5">
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

    <?php endif; ?>

    </div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>