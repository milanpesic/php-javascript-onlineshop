<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

   <div class="col"> 

<div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        Create Product

</div>

<div class="row justify-content-center mb-5">

    <div class="col-9">

        <form action="<?php echo $config['url']['path'] . 'admin-panel/product-create'; ?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">

                <label for="productName">Name*</label>
                <input type="text" name="productName" class="form-control" required>

            </div>

            <div class="form-group">

                <label for="description">Description*</label>
                <textarea name="description" class="form-control" cols="30" rows="10" required></textarea>

            </div>

            <div class="form-group">

                <label for="price">Price*</label>
                <input type="text" name="price" class="form-control" required>

            </div>

            <div class="form-group">

                <label for="priceDiscount">Discount Price</label>
                <input type="text" name="priceDiscount" class="form-control" placeholder = "Leave this field if there is no discount">

            </div>

            <div class="form-group mt-5 mb-5">
            
            <label for="categoryID">Choose a product category:*</label>

                <select class="font-weight-bold form-control" name="categoryID" required>

                <option value="">Please select</option>

                    <?php foreach(DB::find('categories') as $category) : ?>

                        <option value="<?php echo $category->categoryID; ?>"><?php echo $category->categoryName; ?></option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="form-check mb-5">
                
                <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox" onclick="disable()">

                <label class="form-check-label" for="checkbox">Check only if category doesn't have subcategory</label>


            </div>


            <div class="form-group mb-5">
            
            <label for="subcategoryID">Choose a product subcategory:*</label>

                <select class="font-weight-bold form-control" name="subcategoryID" id="subcategoryID" required>

                <option value="">Please select</option>

                    <?php foreach(DB::find('subcategories') as $subcategory) : ?>

                        <option value="<?php echo $subcategory->subcategoryID; ?>"><?php echo $subcategory->subcategoryName; ?></option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label for="image">Image</label>
                <input type="hidden" name="max_file_size" value="2097152">
                <input type="file" name="image" class="form-control-file" onchange="previewFile()" accept="image/*">
                <img src="" width="300" class="border bg-light" id="imagePreview" class="img-fluid">
            </div>

            <div class="form-group">

                <label for="stock">Stock*</label>
                <input type="text" name="stock" class="form-control" required>

            </div>

            <div class="form-group">

                <label for="display">Display*</label>

                <select name="display" class="form-control" required>

                    <option value="">Please select</option>

                    <option value="portrait">Portrait</option>

                    <option value="landscape">Landscape</option>

                </select>

            </div>

            <hr>

            <input type="submit" class="btn btn-primary" value="Create">

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

    function disable(box) {


        const checkbox = document.getElementById('checkbox');
        const subcategory = document.getElementById('subcategoryID');

        subcategory.disabled = true;
        subcategory.selectedIndex = 0;
        
        checkbox.addEventListener("click", function () {
            
            subcategory.disabled = !subcategory.disabled;

        });

    }

</script>

</div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>