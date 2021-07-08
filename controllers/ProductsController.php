<?php

class ProductsController extends Controller  {


    protected $offset;

    protected $limit;



    public function showAll($categorySlug = null, $subcategorySlug = null, $page = null) {

        

        $productsBetween = DB::find('products');

        $page = (!empty($_GET['p']) && $_GET['p'] > 1 ? $_GET['p'] : 1);

        $sort = !empty($_GET['sort']) ? $_GET['sort'] : '';

        $name = !empty($_GET['name']) ? $_GET['name'] : '';

        $price = !empty($_GET['price']) ? $_GET['price'] : '';

        if(!empty($price)) {

            [$minPrice, $maxPrice] = explode('-', $price); 

        }


        $categories = DB::find('categories');

        $category = !empty($categorySlug) ? DB::find('categories', ['categorySlug' => $categorySlug]) : '';

        $subcategory = !empty($subcategorySlug) ? DB::find('subcategories', ['subcategorySlug' => $subcategorySlug]) : '';


        if(!empty($subcategory)) {

            $s = "SELECT * FROM `products` WHERE `price` BETWEEN :minP AND :maxP AND `subcategoryID` = :subcategoryID";

            $p300 = DB::run($s, ['minP' => 0, 'maxP' => 300, 'subcategoryID' => $subcategory->subcategoryID])->fetchAll();
    
            $p900 = DB::run($s, ['minP' => 300, 'maxP' => 900, 'subcategoryID' => $subcategory->subcategoryID])->fetchAll();
    
            $p3000 = DB::run($s, ['minP' => 900, 'maxP' => 3000, 'subcategoryID' => $subcategory->subcategoryID])->fetchAll();

        }


        if(empty($subcategory) && !empty($category)) {

            $s = "SELECT * FROM `products` WHERE `price` BETWEEN :minP AND :maxP AND `categoryID` = :categoryID";

            $p300 = DB::run($s, ['minP' => 0, 'maxP' => 300, 'categoryID' => $category->categoryID])->fetchAll();

            $p900 = DB::run($s, ['minP' => 300, 'maxP' => 900, 'categoryID' => $category->categoryID])->fetchAll();

            $p3000 = DB::run($s, ['minP' => 900, 'maxP' => 3000, 'categoryID' => $category->categoryID])->fetchAll();

        }
        
    
    
        if(!empty($category) && empty($subcategory)) {

            $subcategorySlug = null;

            $productsAll = DB::findAll('products', ['categoryID' => $category->categoryID]);

            [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

            $products = DB::findAll('products', ['categoryID' => $category->categoryID, 'offset' => $offset, 'limit' => $limit]);


            if(!empty($price) && empty($name) && empty($sort)) {

                $sql = "SELECT * FROM `products` WHERE `categoryID` = :categoryID AND `price` BETWEEN :minPrice AND :maxPrice";
                
                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'categoryID' => $category->categoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'categoryID' => $category->categoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();

            } else if(!empty($name) && empty($price) && empty($sort)) {

                $sql = "SELECT * FROM `products` WHERE `categoryID` = :categoryID ORDER BY `productName` " . strtoupper($name);
                
                $products = DB::run($sql, ['categoryID' => $category->categoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['categoryID' => $category->categoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();

            } else if(!empty($sort) && empty($price) && empty($name)) {

                $sql = "SELECT * FROM `products` WHERE `categoryID` = :categoryID ORDER BY `price` " . strtoupper($sort);
                
                $products = DB::run($sql, ['categoryID' => $category->categoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['categoryID' => $category->categoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();
                
            } else if(!empty($price) && !empty($name) && empty($sort)) {

                $sql = "SELECT * FROM `products` WHERE `categoryID` = :categoryID AND `price` BETWEEN :minPrice AND :maxPrice ORDER BY `productName` " . strtoupper($name);

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'categoryID' => $category->categoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'categoryID' => $category->categoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();
                
            } else if(!empty($price) && !empty($sort) && empty($name)) {

                $sql = "SELECT * FROM `products` WHERE `categoryID` = :categoryID AND `price` BETWEEN :minPrice AND :maxPrice ORDER BY `price` " . strtoupper($sort);

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'categoryID' => $category->categoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'categoryID' => $category->categoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();
                
            } else {

            }

        } 
        
        
        if(!empty($category) && !empty($subcategory)) {

            $productsAll = DB::findAll('products', ['subcategoryID' => $subcategory->subcategoryID]);

            [$offset, $limit, $pages] = $this->pagination($page, $productsAll);

            $products = DB::findAll('products', ['subcategoryID' => $subcategory->subcategoryID, 'offset' => $offset, 'limit' => $limit]);


            if(!empty($price) && empty($name) && empty($sort)) {

                $sql = "SELECT * FROM `products` WHERE `subcategoryID` = :subcategoryID AND `price` BETWEEN :minPrice AND :maxPrice";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'subcategoryID' => $subcategory->subcategoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $products);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'subcategoryID' => $subcategory->subcategoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();


            } else if(!empty($name) && empty($price) && empty($sort)) {

                $sql = "SELECT * FROM `products` WHERE `subcategoryID` = :subcategoryID ORDER BY `productName` " . strtoupper($name);

                $products = DB::run($sql, ['subcategoryID' => $subcategory->subcategoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $products);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['subcategoryID' => $subcategory->subcategoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();

            } else if(!empty($sort) && empty($price) && empty($name)) {

                $sql = "SELECT * FROM `products` WHERE `subcategoryID` = :subcategoryID ORDER BY `price` " . strtoupper($sort);

                $products = DB::run($sql, ['subcategoryID' => $subcategory->subcategoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $products);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['subcategoryID' => $subcategory->subcategoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();
         
            } else if(!empty($price) && !empty($name) && empty($sort)) {

                $sql = "SELECT * FROM `products` WHERE `subcategoryID` = :subcategoryID AND `price` BETWEEN :minPrice AND :maxPrice ORDER BY `productName` " . strtoupper($name);
                
                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'subcategoryID' => $subcategory->subcategoryID])->fetchAll();
                
                [$offset, $limit, $pages] = $this->pagination($page, $products);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'subcategoryID' => $subcategory->subcategoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();
                
            } else if(!empty($price) && !empty($sort) && empty($name)) {

                $sql = "SELECT * FROM `products` WHERE `subcategoryID` = :subcategoryID AND `price` BETWEEN :minPrice AND :maxPrice ORDER BY `price` " . strtoupper($sort);
                
                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'subcategoryID' => $subcategory->subcategoryID])->fetchAll();

                [$offset, $limit, $pages] = $this->pagination($page, $products);

                $sql .= " LIMIT :offset, :limit";

                $products = DB::run($sql, ['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'subcategoryID' => $subcategory->subcategoryID, 'offset' => $offset, 'limit' => $limit])->fetchAll();
                
            } else {

            }

        }
           
        

        if(empty($subcategory) && !empty($subcategorySlug) && !is_numeric($subcategorySlug)) {

           //  Redirect::to('404');
     
        } 

        

        return $this->view('products', compact('products', 'category', 'subcategory', 'categorySlug', 'subcategorySlug', 'pages', 'page', 'categories', 'p300', 'p900', 'p3000'));

    }


    public function showDiscountProducts() {

        $productsOnDiscount = DB::find('products');

        $categories = DB::find('categories');

        $products = [];

            foreach($productsOnDiscount as $product) {

                if(!empty($product->priceDiscount)) {
                  
                   $products[] = DB::find('products', ['priceDiscount' => $product->priceDiscount]);    

                }

            }

        return $this->view('products', compact('products', 'categories'));
            
    }

    public function showOne($slug = null) {

        $categories = DB::find('categories');

            $product = DB::find('products', ['slug' => $slug]);

            if($product) {

                return $this->view('product', compact('product', 'categories'));

            } else {

                Redirect::to('404');

            }
        
    }

    public function pagination($page, $productsAll) {

        $limit = 9;

        $offset = ($page - 1) * $limit;

        $total = count($productsAll);

        $pages = ceil($total / $limit);

        return [$offset, $limit, $pages];

    }

}