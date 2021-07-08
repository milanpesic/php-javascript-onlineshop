<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

            Customers

    </div>

    <div class="table-responsive">

        <table class="table table-secondary table-hover table-sm text-center" style="font-size: 14px">

            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Postal</th>
                    <th>Country</th>
                    <th>Registered</th>
                    <th>Created</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <?php if(!empty($customers)) : ?>

                <tbody>

                    <?php foreach($customers as $customer) : ?>
                    
                            <tr>
                                <td class="align-middle"><?php echo $customer->name; ?></td>
                                <td class="align-middle"><?php echo $customer->email; ?></td>
                                <td class="align-middle"><?php echo $customer->phone; ?></td>
                                <td class="align-middle"><?php echo $customer->address; ?></td>
                                <td class="align-middle"><?php echo $customer->city; ?></td>
                                <td class="align-middle"><?php echo $customer->postal; ?></td>
                                <td class="align-middle"><?php echo $customer->country; ?></td>
                                <td class="align-middle"><?php echo $customer->registered; ?></td>
                                <td class="align-middle"><?php echo $customer->created_at; ?></td>
                                <td><a class="btn btn-danger btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/customer-delete/' . $customer->customerID; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                            </tr>
                        
                    <?php endforeach; ?>

                </tbody>

            <?php else : ?>

                <tbody>

                    <tr>
                        <td colspan="6" class="p-5">There are no customers in your database.</td>
                    </tr>

                </tbody>

            <?php endif; ?>

        </table>

    </div>

</div>



<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>