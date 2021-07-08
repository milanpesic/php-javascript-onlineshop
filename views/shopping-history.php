
<?php include('layout/header.php');  ?>


    <?php if(!empty($orderSummary)) : ?>

    <div class="container mt-5 mb-5">
    <h1>Hello, <?php echo Session::set('user')->name; ?>!</h1>

    <div>You shopping cart history:</div>

    <?php foreach($orderSummary as $order) : ?>

        <div class="table-responsive">
        
            <table class="table table-sm table-bordered mt-5 p-0">

                <tr>
                    <th class="text-muted" colspan="5">
                        Shopping date: <?php $date = new DateTime($order[0]->created_at); echo $date->format('H:i a, d M Y'); ?>
                    </th>
                </tr>

                <tr>
                    <th></th>
                    <th>Products</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                </tr>

                <?php foreach($order as $o) : ?>
                    <tr>
                        <td><a href="<?php echo $config['url']['path'] . 'product/' . $o->slug; ?>" target="_blank"><img src="<?php echo $o->image; ?>" width="120" height="90" alt=""></a></td>
                        <td class="align-middle"><a href="<?php echo $config['url']['path'] . 'product/' . $o->slug; ?>" target="_blank"><?php echo substr($o->productName, 0, 50); ?>...</a></td>
                        <td class="align-middle text-center"><?php echo $o->quantity; ?></td>
                        <td class="align-middle text-center"><?php echo $o->price; ?></td>
                        <td class="align-middle text-center"><?php echo number_format($o->price * $o->quantity, 2); ?></td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="align-middle text-center text-nowrap">&euro; +25 tax <br><?php echo '&euro; ' . number_format($o->total, 2); ?></td>
                </tr>

            </table>

        </div>

    <?php endforeach; ?>

    </div>

    <?php else : ?>

        <div class="container alert alert-warning text-center" style="margin-top: 200px; margin-bottom: 200px;">
    
            <h1>Your shopping history is empty!</h1>

        </div>;

    <?php endif; ?>

<?php include('layout/footer.php'); ?>