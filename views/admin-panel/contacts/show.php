
<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col"> 

    <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

            Contacts

    </div>

    <div class="table-responsive badge">

        <table class="table table-secondary table-hover table-sm align-items-center" style="font-size: 14px;">

            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Reply Message</th>
                    <th>Reply</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <?php if(!empty($contacts)) : ?>

                <tbody>

                    <?php foreach($contacts as $contact) : ?>
                    
                            <tr>
                                <td class="align-middle"><?php echo $contact->name; ?></td>
                                <td class="align-middle"><?php echo $contact->email; ?></td>
                                <td class="align-middle"><textarea name="" readonly id="" cols="30" rows="10"><?php echo $contact->text; ?></textarea></td>
                                <td class="align-middle"><textarea name="" id="" cols="30" rows="10"><?php echo !empty($contact->reply) ? $contact->reply : '<span class="btn btn-sm bg-danger">N/A</span>'; ?></textarea></td>
                                <td class="align-middle"><a class="btn btn-primary btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/contact-reply/' . $contact->contactID; ?>">Reply</a></td>
                                <td class="align-middle"><a class="btn btn-danger btn-sm" href="<?php echo $config['url']['path'] . 'admin-panel/contact-delete/' . $contact->contactID; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                            </tr>
                        
                    <?php endforeach; ?>

                </tbody>

            <?php else : ?>

                <tbody>

                    <tr>
                        <td colspan="6" class="p-5">Your contacts are empty.</td>
                    </tr>

                </tbody>

            <?php endif; ?>

        </table>

    </div>

</div>

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>