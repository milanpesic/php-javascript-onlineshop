<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">


           Order Status - <?php echo ($orders[0]->status === 'NEW' ? '<span class="btn btn-secondary">NEW ORDER</span>' : ($orders[0]->status === 'PENDING' ? '<span class="btn btn-warning">PENDING</span>' : ($orders[0]->status === 'CONFIRMED' ? '<span class="btn btn-primary">CONFIRMED</span>' : ($orders[0]->status === 'CANCELLED' ? '<span class="btn btn-danger">CANCELLED</span>' : ($orders[0]->status === 'DELIVERED' ? '<span class="btn btn-success">DELIVERED</span>' : '<span class="btn btn-light">STATUS NOT DEFINED</span>'))))); ?>

    </div>

    <div class="row d-flex justify-content-between mt-5">

        <div class="col-md-6">

            <ul class="list-group">
                <li class="list-group-item text-muted bg-dark"> <h1 class="font-weight-bold">Customer</h1></li>
                <li class="list-group-item"><?php echo $orders[0]->name; ?></li>
                <li class="list-group-item"><?php echo $orders[0]->email; ?></li>
                <li class="list-group-item"><?php echo $orders[0]->phone; ?></li>
                <li class="list-group-item"><?php echo $orders[0]->address; ?></li>  
                <li class="list-group-item"><?php echo $orders[0]->postal . ' ' . $orders[0]->city; ?></li>   
                <li class="list-group-item"><?php echo $orders[0]->country; ?></li>  
            </ul>

        </div>  

        <div class="col-md-6">

            <ul class="list-group">
                <li class="list-group-item text-muted bg-dark"> <h1 class="font-weight-bold">Purchase Details</h1></li>
                <li class="list-group-item"><?php echo 'No. ' . mb_strtoupper(substr($orders[0]->orderNumber, 0, 8), 'UTF-8'); ?></li>
                <li class="list-group-item"><?php echo !empty($orders[0]->registered) ? 'Registered User' : 'Unregistered User'; ?></li>
                <li class="list-group-item"><?php $date = new DateTime($orders[0]->created_at); echo $date->format('H:i a, d M Y'); ?></li>
                <li class="list-group-item"><h3 class="text-success font-weight-bold"><?php echo '&euro; ' . number_format($orders[0]->total, 2); ?></h3></li>

            </ul>

        </div>  

    </div>

    <div class="row d-flex justify-content-between mt-5 mb-5">

        <div class="col-md-12">

            <ul class="list-group">

            <li class="list-group-item text-muted bg-dark"> <h1 class="font-weight-bold">Products</h1></li>

            <?php foreach($orders as $order) : ?>

                <li class="list-group-item d-flex justify-content-between align-items-center">

                    <span><a href="<?php echo $config['url']['path'] . 'product/' . $order->slug; ?>" target="_blank"><?php echo substr($order->productName, 0, 60) . '...'; ?></a></span>

                    <span><?php echo '&euro; ' . $order->price; ?></span> 

                    <span class="badge badge-danger badge-pill"><?php echo $order->quantity; ?></span>
                
                </li>
                

            <?php endforeach; ?>

            </ul>   

        </div>

</div>

        <div class="row d-flex justify-content-between mb-5">

        <div class="col-md-6">

            <ul class="list-group">
                <li class="list-group-item text-muted bg-dark"> <h1 class="font-weight-bold">Totals</h1></li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span> Subtotal: </span> 
                    <span> <?php echo '&euro; ' . number_format($orders[0]->total - 25, 2); ?> </span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">

                    <span> Tax: </span>

                   <span> <?php echo '&euro; ' . number_format(25, 2); ?> </span>
                    
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                
                  <span> Total: </span>
                    
                  <h3> <span class="badge badge-success">  <?php echo '&euro; ' . number_format($order->total, 2); ?>  </span>  </h3>
                
                </li>

            </ul>

        </div>

        <div class="col-md-6">

            <form action="<?php echo $config['url']['path'] . 'admin-panel/order-status/' . $orders[0]->customerID; ?>" method="post">

                <ul class="list-group">
                
                    <li class="list-group-item text-muted bg-dark"> <h1 class="font-weight-bold">Order Status</h1></li>

                    <li class="list-group-item">

                        <select class="form-control" name="orderStatus" required>

                            <option value="">Please select</option>

                            <option value="NEW">NEW</option>

                            <option value="PENDING">PENDING</option>

                            <option value="CONFIRMED">CONFIRMED</option>

                            <option value="CANCELLED">CANCELLED</option>

                            <option value="DELIVERED">DELIVERED</option>

                        </select>
                    
                    </li>

                    <li class="list-group-item"><input type="submit" class="btn btn-primary" value="Update Status"></li>
                
                </ul>

            </form>

        </div>

        </div>

    </div>

</div>



<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>