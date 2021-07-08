

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        <div class="row">

                <div class="col">SubCategories</div>

                <?php if(!empty($showSubCategories)) : ?>

                    <div class="col text-right">

                        <a href="<?php echo $config['url']['path'] . 'admin-panel/subcategory-create'; ?>" class="btn btn-sm btn-dark">Create New SubCategory</a>

                    </div>

                <?php endif; ?>

        </div> 

    </div>

    <div class="table-responsive badge">

        <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

            <thead class="thead-dark">

                <tr>
                    <th class="p-2">Name</th>
                    <th class="p-2">Category</th>
                    <th class="p-2">Edit</th>
                    <th class="p-2">Delete</th>
                </tr>

            </thead>

            <tbody>

            <?php if(!empty($showSubCategories)) : ?>

                <?php foreach($showSubCategories as $subcategory) : ?>

                    <tr>
                    <td class="align-middle"><?php echo $subcategory->subcategoryName; ?></td>
                    <td class="align-middle"><?php echo DB::find('categories', ['categoryID' => $subcategory->categoryID])->categoryName; ?></td>
                    <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/subcategory-edit/' . $subcategory->subcategoryID; ?>" class="btn btn-sm btn-warning shadow-none">Edit</a></td>
                    <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/subcategory-delete/' . $subcategory->subcategoryID; ?>" class="btn btn-sm btn-danger shadow-none" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                    </tr>

                <?php endforeach; ?>

                <?php else : ?>

                    <tr>

                        <td colspan="8" class="p-5">

                            There are no subcategories in your database.

                        <?php if(!empty(DB::find('categories'))) : ?>

                            <div class="col text-center mt-3">

                                <a href="<?php echo $config['url']['path'] . 'admin-panel/subcategory-create'; ?>" class="btn btn-sm btn-dark">Create New SubCategory</a>

                            </div>

                        <?php endif; ?>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    </div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>