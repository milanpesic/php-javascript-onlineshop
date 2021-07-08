<nav class="col-md-3 col-lg-2 d-md-block bg-dark pt-3">
        
        <ul class="list-group text-center mt-3">

            <li class="list-group-item bg-dark nav-item btn-group border-0">
                
                <a href="<?php echo $config['url']['path'] . 'products'; ?>" class="rounded-sm text-warning font-weight-bold btn btn-dark shadow-none nav-link active" style="font-size: 16px; background: black; border-width: 5px!important;">Discount</a>
        
            </li>

            <?php foreach(DB::find('categories') as $category) : ?> 

                <?php $subcategories = DB::findAll('subcategories', ['categoryID' => $category->categoryID]); ?>

                <li class="list-group-item bg-dark btn-group dropright border-0 nav-item"><a class="rounded-sm text-warning font-weight-bold btn btn-dark shadow-none nav-link active" style="background: black; border-width: 5px!important;"  href="<?php echo $config['url']['path'] . 'products/' . $category->categorySlug; ?>" data-toggle="<?php echo !empty($subcategories) ? 'dropdown' : '';  ?>"><?php echo $category->categoryName; ?></a>
                
                    <div class="dropdown-menu bg-dark">

                        <?php foreach($subcategories as $subcategory) : ?> 
                                            
                            <a class="dropdown-item text-warning bg-dark font-weight-bolder small" href="<?php echo $config['url']['path'] . 'products/' . $category->categorySlug . '/' . $subcategory->subcategorySlug; ?>"><?php echo $subcategory->subcategoryName; ?></a>                                     
                            
                        <?php endforeach; ?>
                    
                    </div>
                
                </li>
                            
            <?php endforeach; ?>

        </ul>

    </nav>