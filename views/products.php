
<?php include('layout/header.php');  ?>

<div class="container-fluid">

<?php if(!empty($products)) : ?>

    <div class="row d-flex justify-content-center" style="margin-top: 60px;">

        <div class="col-md-9" style="margin-bottom: 60px;">

            <?php if(!empty($categorySlug)) : ?>

                <?php $categoryName = DB::find('categories', ['categorySlug' => $categorySlug]); ?>

            <?php endif; ?>

            <?php if(!empty($subcategorySlug)) : ?>

                <?php $subcategoryName = DB::find('subcategories', ['subcategorySlug' => $subcategorySlug]); ?>

            <?php endif; ?>

            <?php if(!empty($categoryName) && !empty($subcategoryName)) : ?>

            <div class="text-light" style="font-size: 30px; text-shadow: 2px 2px 4px #000000;">
            
                <div class="text-center font-weight-bold"> <?php echo $categoryName->categoryName . ' (' . $subcategoryName->subcategoryName . ')'; ?> </div>
            
            </div>

            <?php endif; ?>

            <?php if(!empty($categoryName) && empty($subcategoryName)) : ?>

                <div class="text-light" style="font-size: 30px; text-shadow: 2px 2px 4px #000000;">

                    <div class="text-center font-weight-bold"> <?php echo $categoryName->categoryName; ?> </div> 

                </div>

            <?php endif; ?>

        </div>

        <div class="col-md-9">

            <?php include('layout/pagination.php'); ?>

        </div>

        <?php if($products[0]->display === 'portrait') : ?>

            <div class="col-md-9 mt-5">

                <div class="card-deck">

                    <?php foreach($products as $product) : ?>

                        <div class="col-md-4">

                                    <div class="card shadow mb-5 align-text-top">

                                        <div class="embed-responsive embed-responsive-16by9">

                                            <img src="<?php echo $product->image; ?>" class="card-img-top embed-responsive-item" alt="">
                                            
                                        </div>

                                        <div class="card-body">

                                            <p class="card-title small"><?php echo substr($product->productName, 0, 50) . '...'; ?></p>

                                            <p class="d-flex justify-content-between"><span class="badge badge-light text-left" style="font-size: 14px; font-weight: bold;"><?php echo !empty($product->priceDiscount) ? '<del class="text-danger">' . '<span class="text-dark"> &euro; ' . number_format($product->price, 2) . '</span></del>'  : ' &euro; ' . $product->price; ?></span>
                                                    
                                            <?php if(!empty($product->priceDiscount)) : ?>

                                                <span class="badge badge-warning text-right" style="font-size: 14px; font-weight: bold;"><?php echo ' &euro; ' . number_format($product->priceDiscount, 2); ?></span>

                                            <?php endif; ?>

                                            </p>

                                            <hr/>

                                            <a href="<?php echo $config['url']['path'] . 'product' . '/' . $product->slug; ?>" class="btn btn-dark shadow-none btn-block">Details</a>

                                        </div>

                                        <div class="card-footer">

                                            <small class="text-muted">*10% additional discount</small>

                                        </div>

                                    </div>

                        </div>

                    <?php endforeach; ?>
                        
                </div>
        
            </div>

        <?php else : ?>

        <div class="col-md-9 mt-5">

            <div class="card-deck">

                <?php foreach($products as $product) : ?>

                    <div class="col-md-6">

                        <div class="card mb-5 p-3 border" style="border-width: 3px !important;">

                            <div class="row no-gutters">

                                <div class="col-md-3">
                            
                                <!--   <img src="<?php echo $product->image_resized; ?>" class="card-img img-fluid" alt=""> -->

                              
                                    <img src="<?php echo $product->image; ?>" class="card-img" alt="">
                              

                                </div>

                                <div class="col-md-9">

                                <div class="card-body">

                                <p class="card-title"><?php echo substr($product->productName, 0, 50) . '...'; ?></p>

                                    <p class="d-flex justify-content-between"><span class="badge badge-light text-left" style="font-size: 14px; font-weight: bold;"><?php echo !empty($product->priceDiscount) ? '<del class="text-danger">' . '<span class="text-dark"> &euro; ' . number_format($product->price, 2) . '</span></del>'  : ' &euro; ' . $product->price; ?></span>
                                                        
                                        <?php if(!empty($product->priceDiscount)) : ?>

                                            <span class="badge badge-warning text-right" style="font-size: 14px; font-weight: bold;"><?php echo ' &euro; ' . number_format($product->priceDiscount, 2); ?></span>

                                        <?php endif; ?>

                                    </p>
                                    
                                <hr>

                                <a href="<?php echo $config['url']['path'] . 'product' . '/' . $product->slug; ?>" class="btn btn-dark shadow-none btn-block">Details</a>
        
                                    <p class="card-text"><small class="text-muted">*10% additional discount</small></p>

                                </div>

                                </div>
                            
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
                    
        </div>

        <?php endif; ?>

        <div class="col-md-9">

            <?php include('layout/pagination.php'); ?>

        </div>
          
    </div>

<?php else : ?>

<div class="text-center" style="margin-top: 90px;">

    <img src="<?php echo $config['url']['path'] . 'public/images/construction.jpg'; ?>" class="img-fluid img-thumbnail" width="600" height="100">

</div>

<?php endif; ?>

</div>

<?php include('layout/footer.php'); ?>

<script>

    function changeURL(parameter = 1) {

            let priceRange = document.getElementById('priceRange').value;

            let sortRange = document.getElementById('sortRange').value;

            let pagination;

            if(parameter) {

                pagination = 'p='+parameter;

            } else {

                pagination = "<?php echo !empty($_GET['p']) ? 'p=' . $_GET['p'] : ''; ?>";

            }

            var url = "<?php echo $config['url']['path'] . 'products/'; ?>";;

            <?php if(!empty($categorySlug) && empty($subcategorySlug)) : ?>

                url = "<?php echo $config['url']['path'] . 'products/' . $categorySlug; ?>";

            <?php endif; ?>

            <?php if(!empty($categorySlug) && !empty($subcategorySlug)) : ?>

                url = "<?php echo $config['url']['path'] . 'products/' . $categorySlug . '/' . $subcategorySlug; ?>";

            <?php endif; ?>

            

            if(priceRange) {

                if(pagination) {

                    window.location.href = url+'?'+priceRange+'&'+pagination; 

                } else {

                    window.location.href = url+'?'+priceRange; 

                }

            } else if(sortRange) {

                if(pagination) {

                    window.location.href = url+'?'+sortRange+'&'+pagination; 

                } else {

                    window.location.href = url+'?'+sortRange; 

                }

            } else {

                if(pagination) {

                    window.location.href = url+'?'+pagination;

                } else {

                    window.location.href = url;

                }

            } 

            if(priceRange && sortRange) {

                if(pagination) {

                    window.location.href = url+'?'+sortRange+'&'+priceRange+'&'+pagination; 

                } else {

                    window.location.href = url+'?'+sortRange+'&'+priceRange; 

                }

            } 

        }
    

</script>