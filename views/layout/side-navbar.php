
    
    <div class="col-md-1" style="font-size: 16px;">
        
        <ul class="nav flex-column mt-5 mb-5">

            <?php foreach(DB::find('categories') as $category) : ?> 

                <?php $subcategories = DB::findAll('subcategories', ['categoryID' => $category->categoryID]); ?>

                <li class="nav-item"><a class="text-left text-dark nav-link rounded-0 border-0 shadow-none font-weight-bold" href="<?php echo $config['url']['path'] . 'products' . '/' . $category->categorySlug; ?>" data-toggle="<?php echo !empty($subcategories) ? 'collapse' : ''; ?>" data-target="#collapseMenu<?php echo $category->categoryID; ?>" aria-expanded="false" aria-controls="collapseMenu"><?php echo $category->categoryName; ?></a>

                        <?php foreach($subcategories as $subcategory) : ?>  

                            <div class="collapse" id="collapseMenu<?php echo $category->categoryID; ?>">

                                <a class="nav-link text-muted ml-5 font-weight-bold" href="<?php echo $config['url']['path'] . 'products' . '/' . $category->categorySlug . '/' .  $subcategory->subcategorySlug; ?>"><?php echo $subcategory->subcategoryName; ?></a>                                     
                            
                            </div>

                        <?php endforeach; ?>
                
                </li>
                            
            <?php endforeach; ?>

        </ul>

    </div>