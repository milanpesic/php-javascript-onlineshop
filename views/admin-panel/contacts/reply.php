

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

    <div class="col"> 

        <div class="container col border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg" style="border-width: 5px!important;">

                <div>Reply To - <?php echo $contact->name . ' | ' . $contact->email; ?></div>
                
        </div>

        <div class="row justify-content-center mb-5">

            <div class="col-9">

                <form action="<?php echo $config['url']['path'] . 'admin-panel/reply-email'; ?>" method="POST">

                    <div class="form-group">

                        <label for="contact-request" class="badge badge-danger" style="font-size: 14px;">Message</label>

                        <textarea class="form-control" name="contact-request" cols="30" rows="10"><?php echo $contact->text; ?></textarea>

                    </div>

                    <div class="form-group">

                        <label for="contact-reply" class="badge badge-primary" style="font-size: 14px;">Reply Message</label>

                        <textarea class="form-control" name="contact-reply" cols="30" rows="10" required></textarea>

                    </div>

                    <hr>

                    <input type="hidden" name="contactID" value="<?php echo $contact->contactID; ?>">

                    <input type="hidden" name="name" value="<?php echo $contact->name; ?>">

                    <input type="hidden" name="email" value="<?php echo $contact->email; ?>">

                    <input type="submit" class="btn btn-primary" value="Reply">

                </form>

            </div>

        </div>

    </div>

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>