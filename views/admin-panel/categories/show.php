<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

   <div class="col"> 

        <div class="container border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

            <div class="row">

              <div class="col">Categories</div>

              <?php if(!empty($showCategories)) : ?>

              <div class="col text-right">

                  <a href="<?php echo $config['url']['path'] . 'admin-panel/category-create'; ?>" class="btn btn-sm btn-dark">Create New Category</a>
            
              </div>

              <?php endif; ?>

            </div> 

        </div>

        <div class="table-responsive badge">

        <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

          <thead class="thead-dark">

            <tr>
              <th class="p-2">Name</th>
              <th class="p-2">Edit</th>
              <th class="p-2">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php if(!empty($showCategories)) : ?>

          <?php foreach($showCategories as $category) : ?>

            <tr>
              <td class="align-middle"><?php echo $category->categoryName; ?></td>
              <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/category-edit/' . $category->categoryID; ?>" class="btn btn-sm btn-warning shadow-none">Edit</a></td>
              <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'admin-panel/category-delete/' . $category->categoryID; ?>" class="btn btn-sm btn-danger shadow-none" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
            </tr>

        <?php endforeach; ?>

        <?php else : ?>

            <tr>

              <td colspan="8" class="p-5">

                  There are no categories in your database. 

                  <div class="col text-center mt-3">

                    <a href="<?php echo $config['url']['path'] . 'admin-panel/category-create'; ?>" class="btn btn-sm btn-dark">Create New Category</a>
            
                  </div>

              </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

    </div>

    </div>

    <?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>