<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

            Users

    </div>

    <div class="table-responsive badge">

        <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Joined</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <?php if(!empty($users)) : ?>

                <tbody>

                    <?php foreach($users as $user) : ?>
                    
                            <tr>
                                <td class="align-middle"><?php echo $user->username; ?></td>
                                <td class="align-middle"><?php echo $user->email; ?></td>
                                <td class="align-middle"><?php echo $user->name; ?></td>
                                <td class="align-middle"><?php echo $user->active; ?></td>
                                <td class="align-middle"><?php echo $user->joined; ?></td>
                                <td><a class="btn btn-danger btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/user-delete/' . $user->id; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                            </tr>
                        
                    <?php endforeach; ?>

                </tbody>

            <?php else : ?>

                <tbody>

                    <tr>
                        <td colspan="6" class="p-5">There are no users in your database.</td>
                    </tr>

                </tbody>

            <?php endif; ?>

        </table>

    </div>

</div>



<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>