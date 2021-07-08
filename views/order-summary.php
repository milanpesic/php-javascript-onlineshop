
<?php include('layout/header.php'); ?>

<div id="section-to-print">

<div class="container mt-5 p-5 col-9" style="font-size: 14px;">

<h3 class=""> Order Summary </h3>

    <div class="row mt-5">  

        <div class="col text-right">

            <div class="font-weight-bold">Order Date</div>

            <div class="text-muted"><?php $date = new DateTime($orderSummary[0]->created_at); echo $date->format('H:i a, d M Y'); ?></div>
            
        </div>

    </div>

    <hr>

        <div class="row mt-5 mb-5">

            <div class="col">
       
                <div class="table-responsive">

                    <table class="table table-sm table-borderless">

                        <tbody>

                            <tr>

                                <th class="text-left">Shipping data</th><th class="text-right">Vendor</th>

                            </tr>

                            <tr>
                                 <td class="text-left text-muted"><?php echo $orderSummary[0]->name; ?></td><td class="text-muted text-right">Online Shop</td>
                            </tr>

                            <tr>
                                <td class="text-left text-muted"><?php echo $orderSummary[0]->email; ?></td><td class="text-muted text-right">online.shop@example.com</td>
                            </tr>
                            
                            <tr>
                                 <td class="text-left text-muted"><?php echo $orderSummary[0]->phone; ?></td><td class="text-muted text-right">061.234.5678</td>
                            </tr>

                            <tr>
                                 <td class="text-left text-muted"><?php echo $orderSummary[0]->address; ?></td><td class="text-muted text-right">Example 12</td>
                            </tr>

                            <tr>
                                 <td class="text-left text-muted"><?php echo $orderSummary[0]->city; ?></td><td class="text-muted text-right">Leskovac</td>
                            </tr>

                            <tr>
                                 <td class="text-left text-muted"><?php echo $orderSummary[0]->postal; ?></td><td class="text-muted text-right">16000</td>
                            </tr>

                            <tr>
                                 <td class="text-left text-muted"><?php echo $orderSummary[0]->country; ?></td><td class="text-muted text-right">Serbia</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
     
    <hr>

    <div class="row mt-5 mb-5">

        <div class="col">

            <div class="table-responsive">

                <table class="table table-sm table-borderless">

                    <tbody>

                        <tr>

                            <th class="text-left">Description</th> 

                            <th class="text-center">Quantity</th> 

                            <th class="text-right">Price</th> 

                            <th class="text-right">Amount</th> 

                        </tr>

                        <?php foreach($orderSummary as $order) : ?>

                        <tr>

                            <td class="p-3 text-muted align-middle"><img src="<?php echo $order->image; ?>" width="60" class="mr-3 img-fluid img-thumbnail" alt=""> <?php echo $order->productName; ?></td>

                            <td class="p-3 text-muted align-middle text-center"><?php echo $order->quantity; ?></td>

                            <td class="p-3 text-muted align-middle text-right"><?php echo '&euro; ' . number_format($order->price, 2); ?></td>

                            <td class="p-3 text-muted align-middle text-right"><?php echo '&euro; ' . number_format($order->price * $order->quantity, 2); ?></td>


                        </tr>

                        <?php endforeach; ?>

                    </tbody>
                
                </table>

            </div>

            

        </div>

    </div>

    <hr>

    <div class="row mt-5 mb-5 justify-content-end">
    
        <div class="col-auto">

            <div class="table-responsive">

                <table class="table table-sm table-borderless ">

                    <tbody>

                        <tr>
                            <th class="text-right">SubTotal:</th> <td class="text-right font-weight-bold text-muted"><?php echo '&euro; ' . number_format($order->total - 25, 2); ?></td>
                        </tr>

                        <tr>
                            <th class="text-right">Shipping:</th> <td class="text-right font-weight-bold text-muted"><?php echo '&euro; ' . number_format(25, 2); ?></td>
                        </tr>
                        
                        <tr>
                            <th class="text-right">Total:</th> <td class="text-right font-weight-bold text-success"><?php echo '&euro; ' . number_format($order->total, 2); ?></td>
                        </tr>

                    </tbody>
                
                </table>

            </div>

        </div>

    </div>

    <hr>

    <button class="mt-5" onclick="window.print()">Print this page</button>

    </div>

<?php include('layout/footer.php'); ?>