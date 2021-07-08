
<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

<div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        Create Category

</div>

<div class="row justify-content-center mb-5">

    <div class="col-9">

        <form action="<?php echo $config['url']['path'] . 'admin-panel/category-create'; ?>" method="POST">

            <div class="form-group">

                <label for="categoryName">Name</label>
                <input type="text" name="categoryName" class="form-control" required>

            </div>

            <hr>

            <input type="submit" class="btn btn-primary" value="Create">

        </form>

    </div>

</div>

</div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>
