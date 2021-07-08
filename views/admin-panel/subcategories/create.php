
<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

<div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        Create SubCategory

</div>

<div class="row justify-content-center mb-5">

    <div class="col-9">

        <form action="<?php echo $config['url']['path'] . 'admin-panel/subcategory-create'; ?>" method="POST">

            <div class="form-group">

                <label for="subCategoryName">Name</label>

                <input type="text" name="subCategoryName" class="form-control" required>

            </div>

            <div class="form-group">
            
            <label for="categoryID">Choose a category:</label>

                <select class="font-weight-bold" name="categoryID" required>

                <option value="">Please select</option>

                    <?php foreach($selectCategories as $category) : ?>

                        <option value="<?php echo $category->categoryID; ?>"><?php echo $category->categoryName; ?></option>

                    <?php endforeach; ?>

                </select>

            </div>

            <hr>

            <input type="submit" class="btn btn-primary" value="Create">

        </form>

    </div>

</div>

</div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>