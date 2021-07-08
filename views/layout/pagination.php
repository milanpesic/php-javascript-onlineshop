
<?php if(!empty($categorySlug) || !empty($subcategorySlug)) :?>

<div class="row justify-content-between shadow p-1" style="background: lightgrey;">

    <div class="col-xs-auto align-self-center">

        <select onchange="changeURL()" class="form-control form-control-sm badge shadow-none" id="priceRange">

            <option value = "">Price:</option>

            <?php if(!empty($p300)) : ?> <option value = "<?php echo 'price=0-300'; ?>" <?php echo (!empty($_GET['price']) && $_GET['price'] === '0-300') ? 'selected' : ''; ?>><?php echo !empty($p300) ? '0 - 300.00 &euro;' : ''; ?> </option> <?php endif; ?>

            <?php if(!empty($p900)) : ?> <option value = "<?php echo 'price=300-900'; ?>" <?php echo (!empty($_GET['price']) && $_GET['price'] === '300-900') ? 'selected' : ''; ?>><?php echo !empty($p900) ? '300.00 - 900.00 &euro;' : ''; ?> </option> <?php endif; ?>

            <?php if(!empty($p3000)) : ?> <option value = "<?php echo 'price=900-3000'; ?>" <?php echo (!empty($_GET['price']) && $_GET['price'] === '900-3000') ? 'selected' : ''; ?>><?php echo !empty($p3000) ? '900.00 - 3,000.00 &euro;' : ''; ?> </option> <?php endif; ?>

        </select>

    </div>

    <div class="col-xs-auto">

        <?php if(!empty($pages) && $pages > 1) : ?>
        
            <ul class="pagination pagination-sm">

                <li class="page-item <?php if($page < 2) { echo 'disabled'; } ?>">

                    <input style="font-size: 12px;" onclick="return changeURL(document.getElementById('previous').value);" class="page-link text-dark shadow-none font-weight-bold" type="button" value="Previous">

                    <input id="previous" type="hidden" value="<?php echo $previous = $page - 1; ?>">

                </li>

                <?php for($x = 1; $x <= $pages; $x++) : ?>            

                    <li class="page-item <?php if($page == $x) { echo 'active'; } ?>" aria-current="page">

                    <input style="font-size: 12px;" onclick="changeURL(this.value)" class="page-link text-dark shadow-none font-weight-bold" type="button" value="<?php echo $x; ?>">

                    </li>

                <?php endfor; ?>
            
                <li class="page-item <?php if($page >= $pages) { echo 'disabled'; } ?>">

                    <input style="font-size: 12px;" onclick="return changeURL(document.getElementById('next').value);" class="page-link text-dark shadow-none font-weight-bold" type="button" value="Next">

                    <input id="next" type="hidden" value="<?php echo $next = $page + 1; ?>">

                </li>
                            
            </ul>
            
        <?php endif; ?>

    </div>

    <div class="col-xs-auto align-self-center">

        <select onchange="changeURL()" class="form-control form-control-sm badge shadow-none" id="sortRange">

            <option value = "">Sort by:</option>

            <option value = "<?php echo 'sort=asc'; ?>" <?php echo !empty($_GET['sort']) && $_GET['sort'] === 'asc' ? 'selected' : ''; ?>>Price: Low - High</option>

            <option value = "<?php echo 'sort=desc'; ?>" <?php echo !empty($_GET['sort']) && $_GET['sort'] === 'desc' ? 'selected' : ''; ?>>Price: High - Low</option>

            <option value = "<?php echo 'name=asc'; ?>" <?php echo !empty($_GET['name']) && $_GET['name'] === 'asc' ? 'selected' : ''; ?>>Name: A - Z</option>

            <option value = "<?php echo 'name=desc'; ?>" <?php echo !empty($_GET['name']) && $_GET['name'] === 'desc' ? 'selected' : ''; ?>>Name: Z - A</option>

        </select>

    </div>

</div>

<?php endif; ?>