
<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

        <div class="row">

            <div class="col">Newsletter</div>

            <div class="col text-right">
        
                <a href="<?php echo $config['url']['path'] . 'admin-panel/newsletter'; ?>" class="btn btn-sm btn-dark">Send Newsletter</a>
    
            </div>

        </div>
       
    </div>

    <div class="table-responsive badge">

        <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

            <thead class="thead-dark">
                <tr>
                    <th>Newsletter Email</th>
                    <th>Active</th>        
                    <th>Delete</th>
                </tr>
            </thead>

            <?php if(!empty($newsletterEmail)) : ?>

                <tbody>

                    <?php foreach($newsletterEmail as $newsletter) : ?>
                    
                            <tr>
                                <td class="align-middle"><?php echo $newsletter->email; ?></td>
                                <td class="align-middle"><?php echo !empty($newsletter->active) ? 'yes' : 'no'; ?></td>
                                <td><a class="btn btn-danger btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/newsletter-delete/' . $newsletter->newsletterID; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                            </tr>
                        
                    <?php endforeach; ?>

                </tbody>

            <?php else : ?>

                <tbody>

                    <tr>
                        <td colspan="6" class="p-5">Your newsletter are empty.</td>
                    </tr>

                </tbody>

            <?php endif; ?>

        </table>

    </div>

</div>

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>