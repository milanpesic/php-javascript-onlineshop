<?php include(dirname(__FILE__) . '/../../admin-layout/admin-header.php'); ?>

<div class="col">

  <?php if(!Session::has('newsletterSend')) : ?>

    <div class="container border-left border-warning table-secondary font-weight-bold mt-3 mb-3 p-3 rounded-lg">

      <form action="<?php echo $config['url']['path'] . 'admin-panel/newsletter-send'; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">

          <label for="newsletterFile">Newsletter </label>

          <input type="file" accept=".doc,.docx,.pdf" name="newsletter" class="form-control-file" id="newsletterFile" required>

          <hr>

          <input type="submit" class="btn btn-primary" value="Send Newsletter">

        </div>

      </form>

    </div>

    <?php echo !empty($error) ? '<div class="alert alert-danger">' . $error[0] . '</div>' : ''; ?>

    <?php else : ?>

      <div class="mt-5 alert alert-warning">

        <?php echo Session::get('newsletterSend'); ?>

      </div>

    <?php endif; ?>
    
</div>

<?php include(dirname(__FILE__) . '/../../admin-layout/admin-footer.php'); ?>