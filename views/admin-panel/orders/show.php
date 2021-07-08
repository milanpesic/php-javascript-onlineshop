<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        <div class="row">

            <div class="col-md-auto align-self-center"> Orders <?php echo Session::has('updateOrderStatus') ? ' - ' . '<span class="alert alert-warning">' . Session::get('updateOrderStatus') . '</span>' : ''; ?> </div>

                <form action="<?php echo $config['url']['path'] . 'admin-panel/order-search-result'; ?>" class="col-md-5 input-group" method="post">

                    <input id="name" type="text" class="form-control form-control-sm shadow-none" name="name" required>

                    <div class="input-group-append">

                        <input type="submit" class="btn btn-dark btn-sm shadow-none" id="search" onclick="return enableSearch()" value="Search">

                    </div>

                </form>

        </div>

    </div>

    <div class="table-responsive badge mt-3">

        <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th>Created</th>
                    <th>Process</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <?php if(!empty($orders)) : ?>
                
                <tbody>

                    <?php foreach($orders as $order) : ?>
                    
                            <tr>
                                <td class="align-middle"><?php echo $order->name; ?></td>
                                <td class="align-middle"><?php echo $order->email; ?></td>
                                <td class="align-middle"><?php echo ($order->status === 'NEW' ? '<span class="btn btn-secondary btn-sm">NEW ORDER</span>' : ($order->status === 'PENDING' ? '<span class="btn btn-warning btn-sm">PENDING</span>' : ($order->status === 'CONFIRMED' ? '<span class="btn btn-primary btn-sm">CONFIRMED</span>' : ($order->status === 'CANCELLED' ? '<span class="btn btn-danger btn-sm">CANCELLED</span>' : ($order->status === 'DELIVERED' ? '<span class="btn btn-success btn-sm">DELIVERED</span>' : '<span class="btn btn-light btn-sm">STATUS NOT DEFINED</span>'))))); ?> </td>
                                <td class="align-middle"><?php echo $order->registered; ?></td>
                                <td class="align-middle"><?php $date = new DateTime($order->created_at); echo $date->format('H:i a, d M Y'); ?></td>
                                <td><a class="btn btn-primary btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/order-status/' . $order->customerID; ?>" target="_blank">Process Order</a></td>
                                <td><a class="btn btn-danger btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/order-delete/' . $order->customerID; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                            </tr>
                        
                    <?php endforeach; ?>

                </tbody>

            <?php else : ?>

                <tbody>

                    <tr>
                        <td colspan="6" class="p-5">There are no orders in your database.</td>
                    </tr>

                </tbody>

            <?php endif; ?>

        </table>

    </div>

</div>



<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>