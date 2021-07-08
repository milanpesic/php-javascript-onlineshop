
<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

<div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        Update Product - <?php echo $editProduct->productName; ?>
        
</div>

<div class="row justify-content-center mb-5">

    <div class="col-9">

        <form action="<?php echo $config['url']['path'] . 'admin-panel/product-preview/' . $editProduct->productID; ?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">

                <label for="productName">Name</label>
                <input type="text" name="productName" class="form-control" value="<?php echo $editProduct->productName; ?>">

            </div>

            <div class="form-group">

                <label for="description">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $editProduct->description; ?></textarea>

            </div>

            <div class="form-group">

                <label for="price">Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $editProduct->price; ?>">

            </div>

            <div class="form-group">

                <label for="priceDiscount">Price Discount</label>
                <input type="text" name="priceDiscount" class="form-control" value="<?php echo !empty($editProduct->priceDiscount) ? $editProduct->priceDiscount : ''; ?>" placeholder="Leave this field empty if there is not discount">

            </div>

            <div class="form-group mt-5 mb-5">
            
            <label for="categoryID">Update a product category:*</label>

                <select class="font-weight-bold form-control" name="categoryID" required>

                <option value="">Please select</option>

                    <?php foreach(DB::find('categories') as $category) : ?>

                        <option value="<?php echo $category->categoryID; ?>" <?php echo ($category->categoryID == $editCategory->categoryID) ? 'selected' : ''; ?>><?php echo $category->categoryName; ?></option>  

                    <?php endforeach; ?>

                </select>

            </div>

           

            <div class="form-check mb-5">
                
                <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox" onclick="disable()">

                <label class="form-check-label font-weight-bold" for="checkbox">Check only if category doesn't have subcategory, uncheck if it does.</label>

            </div>

         
            <div class="form-group mb-5" id="subcategoryDIV">
            
            <label for="subcategoryID">Update a product subcategory:*</label>

                <select class="font-weight-bold form-control" name="subcategoryID" id="subcategoryID" required>

                <option value="">Please select</option>

                    <?php foreach(DB::find('subcategories') as $subcategory) : ?>

                        <option value="<?php echo $subcategory->subcategoryID; ?>" <?php echo (!empty($editSubcategory) && $subcategory->subcategoryID == $editSubcategory->subcategoryID) ? 'selected' : ''; ?>><?php echo $subcategory->subcategoryName; ?></option>


                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label for="image">Image</label>
                <input type="hidden" name="max_file_size" value="2097152">
                <input type="file" name="image" class="form-control-file" onchange="previewFile()" accept="image/*">
                <img src="<?php echo $editProduct->image; ?>" width="300" class="border bg-light" id="imagePreview" class="img-fluid"  >
            </div>

            <div class="form-group">

                <label for="stock">Stock</label>
                <input type="text" width="100" height="100" name="stock" class="form-control" value="<?php echo !empty($editProduct->stock) ? $editProduct->stock : ''; ?>">

            </div>

            <hr>

            <input type="submit" class="btn btn-primary" value="Update">

        </form>

    </div>

</div>

<script>

    function previewFile() {

        const preview = document.getElementById('imagePreview');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            // convert image file to base64 string
            preview.src = reader.result;

        }, false);

        if (file) {

            reader.readAsDataURL(file);

        }
    }

    function disable() {

        const subcategory = document.getElementById('subcategoryID');
        const subcategoryDIV = document.getElementById('subcategoryDIV');


        subcategory.disabled = !subcategory.disabled;

            if(subcategory.disabled) {

                subcategoryDIV.style.display = 'none';

            } else {

                subcategoryDIV.style.display = 'block';

            }

    }

</script>

</div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>
