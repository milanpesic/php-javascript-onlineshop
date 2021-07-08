

<nav class="navbar navbar-expand-lg navbar-dark bg-light" style="background: black; color: black; font-size: 18px;">

    <a class="navbar-brand" href="<?php echo $config['url']['path']; ?>"><img class="img-fluid" src="<?php echo $config['url']['path'] . 'public/images/online-shop.png'; ?>"  alt="Responsive image" width="150" height="100"></a>
    
        <?php if(!Session::has('user')) : ?>

        <nav class="ml-auto">

                <a class="text-decoration-none font-weight-bold text-dark shadow-none" style="font-size: 16px; border-width:3px!important;" href="<?php echo $config['url']['path'] . 'sign-up'; ?>">Sign Up</a>

                <span class="text-dark">|</span>

                <a class="text-decoration-none font-weight-bold text-dark shadow-none" style="font-size: 16px; border-width:3px!important;" href="<?php echo $config['url']['path'] . 'sign-in'; ?>">Sign In</a>

                <span class="text-dark">|</span>

        <?php else : ?>
        
        <?php $user = Session::set('user'); ?>

        <div class="nav text-center ml-auto">

            <div class="dropdown mr-3">

                <button class="btn btn-outline-secondary dropdown-toggle shadow-none" style="border-width: 3px !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile Info
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    
                    <a class="dropdown-item font-weight-bold" href="<?php echo $config['url']['path'] . 'shopping-history'; ?>">Shopping history</a>

                    <a class="dropdown-item font-weight-bold" href="<?php echo $config['url']['path'] . 'update-profile'; ?>">Update profile</a>
                            
                    <a class="dropdown-item font-weight-bold" href="<?php echo $config['url']['path'] . 'sign-out'; ?>">Sign Out</a>
                        
                </div>

            </div>

        </div>                                                                           
        
    <?php endif; ?>   

        <a class="text-decoration-none font-weight-bold text-dark" style="border-width: 3px !important" href="<?php echo $config['url']['path'] . 'cart'; ?>">
                <svg width="2em" height="2em" viewBox="0 0 20 20" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
            <sup class="badge badge-danger align-top" style="margin-left: -10px;"><?php echo count($cart); ?></sup>           
        </a>

    </nav>

</nav>

<?php $url = !empty($_GET['url']) ? explode('/', $_GET['url']) : ''; ?>

    <nav class="navbar navbar-expand-md navbar-dark" style="background: black;">

        <div class="nav mr-auto">

            <a class="nav-item nav-link font-weight-bold hoverLInk <?php echo ($_GET['url'] === 'home') || empty($_GET['url']) ? 'activeLink' : ''; ?>" style="color: white;" href="<?php echo $config['url']['path'] . 'home'; ?>">HOME</a>

            <div class="dropdown" onmouseleave="return closeDropdown()">
  
                <a id="stayHover" class="nav-item nav-link font-weight-bold hoverLInk <?php echo !empty($url[1]) ? 'activeLink' : ''; ?>" style="color: white;" onmouseover="openDropdown();" onclick="return false" href="<?php echo $config['url']['path'] . 'products'; ?>">PRODUCTS</a>
  
                <div id="openDropdown" class="dropdown-menu p-0 border-0 dropright shadow rounded-0" style="background: lightgrey;">

                    <?php foreach(DB::find('categories') as $category) : ?> 

                        <?php $subcategories = DB::findAll('subcategories', ['categoryID' => $category->categoryID]); ?>
                       
                        <div class="position-relative" onmouseleave="return closeSubDropdown(<?php echo $category->categoryID; ?>);">

                            <a class="dropdown-item active-hover activeItem font-weight-bold position-relative" onmouseover="return openSubDropdown(<?php echo $category->categoryID; ?>);" data-toggle="<?php echo !empty($subcategories) ? 'dropdown' : ''; ?>" href="<?php echo $config['url']['path'] . 'products' . '/' . $category->categorySlug; ?>"><?php echo $category->categoryName; ?></a>

                            <?php if(!empty($subcategories)) : ?>

                                <div id="openSubDropdown-<?php echo $category->categoryID; ?>" class="dropdown-menu bg-light p-0 border-0 rounded-0 shadow">

                                    <?php foreach($subcategories as $subcategory) : ?>  

                                        <a class="dropdown-item text-muted active-hover font-weight-bold"  href="<?php echo $config['url']['path'] . 'products' . '/' . $category->categorySlug . '/' .  $subcategory->subcategorySlug; ?>"><?php echo $subcategory->subcategoryName . ' (' . count(DB::findAll('products', ['subcategoryID' => $subcategory->subcategoryID])) .') '; ?></a>                                     

                                    <?php endforeach; ?>

                                </div>

                            <?php endif; ?>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <a class="nav-item nav-link font-weight-bold hoverLInk <?php echo ($_GET['url'] === 'about') ? 'activeLink' : ''; ?>" style="color: white;" href="<?php echo $config['url']['path'] . 'about'; ?>">ABOUT</a>

            <a class="nav-item nav-link font-weight-bold hoverLInk <?php echo ($_GET['url'] === 'contact') ? 'activeLink' : ''; ?>" style="color: white;" href="<?php echo $config['url']['path'] . 'contact'; ?>">CONTACT</a>
            
            
        </div>

        <div class="nav ml-auto">

        <form action="<?php echo $config['url']['path'] . 'search-result'; ?>" method="post" class="form-inline mt-2 mt-md-0">
        <input id="productName" class="form-control mr-sm-2" type="text" placeholder="Search..." size="50" name="productName" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 shadow-none" id="search" onclick="return enableSearch()" type="submit">Search</button>
      </form>

    </div>
        
</nav>