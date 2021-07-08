<?php

class AdminController extends Controller {

    protected $form;

    public function __construct() {

        $this->form = new Validator;

        if(!Session::has('admin') && $_SERVER['REQUEST_METHOD'] === 'GET') { 

            Redirect::to('admin-panel/sign-in');
            
        } 

    }


    public function adminPanel() {

        return $this->view('admin-panel/welcome');

    }
   
    public function adminSignIn() {

        if(!empty($_POST)) {

            $errors = $this->form->validate($_POST, [

                'username' => ['required' => true],
                'password' => ['required' => true],
                'csrf_token' => ['token' => true]

            ]);

            if(!$errors->errorHasFound()) {

            $admin = DB::run("SELECT * FROM `admin` WHERE `username` = :username", ['username' => $this->request('username')])->fetch();
            
                if($admin && password_verify($this->request('password'), $admin->password)) {
                
                    Session::put('admin', $admin);

                    Redirect::to('admin-panel');

                } else {

                    Session::put('admin-warning', 'Username or password is not correct!');

                } 
                
            }

        }

        return $this->view('admin-panel/sign-in', compact('errors'));

    }

    public function adminShowProducts() {

        $showProducts = DB::find('products');

        $showCategories = DB::find('categories');

        $showSubCategories = DB::find('subcategories');

        return $this->view('admin-panel/products/show', compact('showProducts', 'showCategories', 'showSubCategories'));

    }

    public function adminShowProductForm() {

            return $this->view('admin-panel/products/create');

    }


    public function adminCreate($productID = null) {

        $config = Config::instance();

        if(isset($_FILES['image'])) {

            $file = $_FILES['image'];

            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];

            $image_size = getimagesize($file_tmp);
            $width = $image_size[0];
            $height = $image_size[1];
            $image_type = $image_size[2];

            $file_size = $file['size'];
            $file_error = $file['error'];

            $allowTypes = ['jpg','png','jpeg','gif'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            if(in_array($file_ext, $allowTypes) && empty($file_error) && $file_size <= 2097152) {

                $file_name_uploaded = hash('sha512', $file_name) . '.' . $file_ext;
                $file_folder = 'public/images/' . $file_name_uploaded;

                $file_resize_folder = 'public/images_resized/' . $file_name_uploaded;

                switch ($image_type) {
                    case IMAGETYPE_JPEG:
                        $resource_type = imagecreatefromjpeg($file_tmp); 
                        $image_resize = $this->adminImageResize($resource_type, $width, $height);
                        imagejpeg($image_resize, $file_resize_folder, 100);
                        break;
        
                    case IMAGETYPE_GIF:
                        $resource_type = imagecreatefromgif($file_tmp); 
                        $image_resize = $this->adminImageResize($resource_type, $width, $height);
                        imagegif($image_resize, $file_resize_folder, 100);
                        break;
        
                    case IMAGETYPE_PNG:
                        $resource_type = imagecreatefrompng($file_tmp); 
                        $image_resize = $this->adminImageResize($resource_type, $width, $height);
                        imagepng($image_resize, $file_resize_folder, 100);
                        break;
        
                    default:
                       // $file_resize_folder = 'public/images_resized/no-image.png';
                        break;
                    }
         
                if(move_uploaded_file($file_tmp, $file_folder)) {

                    $imageUpload = $config['url']['path'] . $file_folder;
                            
                    $imageResizedUpload = $config['url']['path'] . $file_resize_folder;

                } else {

                    $imageUpload = $config['url']['path'] . 'public/images/' . 'no-image.png';
            
                    $imageResizedUpload = $config['url']['path'] . 'public/images_resized/' . 'no-image.png';

                }

            }  

        } 

        if(!empty($_POST)) { 

            $createProduct = DB::create('products', [

                'productName' => $this->request('productName'),

                'description' => $this->request('description'),

                'price' => $this->request('price'),

                'priceDiscount' => $this->request('priceDiscount'),

                'image' => $imageUpload,

                'image_resized' => $imageResizedUpload,

                'slug' => $this->adminCreateSlug($this->request('productName')),

                'stock' => $this->request('stock'),

                'categoryID' => $this->request('categoryID'),

                'subcategoryID' => $this->request('subcategoryID'),

                'display' => $this->request('display'),

            ], ['productName', 'description', 'price', 'priceDiscount', 'image', 'image_resized', 'slug', 'stock', 'categoryID', 'subcategoryID', 'display']);

            $lastInsertId = Connection::lastInsertId();

            if($createProduct) {

                $newProduct = DB::find('products', ['productID' => $lastInsertId]);

                Session::put('newProduct', $newProduct);

                Session::put('createdProduct', 'Your new product was successfully created!');

                Redirect::to('admin-panel/products-show');

            }
        
        }

    }


    public function adminProductPreview($productID = null) {

        $updatedProduct = DB::find('products', ['productID' => $productID]);

        if($updatedProduct) {

            return $this->view('admin-panel/products/updatedProduct', compact('updatedProduct'));

        } else {

            Redirect::to('admin-panel/products-show');

        }
      
    }

    public function adminUpdate($productID = null) {

        $config = Config::instance();

        $product = DB::find('products', ['productID' => $productID]);


        if(!empty($product->image) && !empty($product->image_resized)) {

            $imageUpload = $product->image;
                    
            $imageResizedUpload = $product->image_resized;   
            
        }

        if(is_uploaded_file($_FILES['image']['tmp_name'])) {

            if(isset($_FILES['image'])) {

                $file = $_FILES['image'];
    
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
    
                $image_size = getimagesize($file_tmp);
                $width = $image_size[0];
                $height = $image_size[1];
                $image_type = $image_size[2];
    
                $file_size = $file['size'];
                $file_error = $file['error'];
    
                $allowTypes = ['jpg','png','jpeg','gif'];
    
                $file_ext = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext));
    
                if(in_array($file_ext, $allowTypes) && empty($file_error) && $file_size <= 2097152) {
    
                    $file_name_uploaded = hash('sha512', $file_name) . '.' . $file_ext;
                    $file_folder = 'public/images/' . $file_name_uploaded;
    
                    $file_resize_folder = 'public/images_resized/' . $file_name_uploaded;
    
                    switch ($image_type) {
    
                        case IMAGETYPE_JPEG:
                            $resource_type = imagecreatefromjpeg($file_tmp); 
                            $image_resize = $this->adminImageResize($resource_type, $width, $height);
                            imagejpeg($image_resize, $file_resize_folder, 100);
                            break;
            
                        case IMAGETYPE_GIF:
                            $resource_type = imagecreatefromgif($file_tmp); 
                            $image_resize = $this->adminImageResize($resource_type, $width, $height);
                            imagegif($image_resize, $file_resize_folder, 100);
                            break;
            
                        case IMAGETYPE_PNG:
                            $resource_type = imagecreatefrompng($file_tmp); 
                            $image_resize = $this->adminImageResize($resource_type, $width, $height);
                            imagepng($image_resize, $file_resize_folder, 100);
                            break;
            
                        default:
                           // $file_resize_folder = 'public/images_resized/no-image.png';
                            break;
                        }
      
                    if(move_uploaded_file($file_tmp, $file_folder)) {
        
                        $imageUpload = $config['url']['path'] . $file_folder;
                                    
                        $imageResizedUpload = $config['url']['path'] . $file_resize_folder;
        
                    }

                }

            }

        }
                                                      
        if(!empty($_POST)) { 

            $updateProduct = DB::update('products', [

                'productID' => $productID,

                'productName' => $this->request('productName'),

                'description' => $this->request('description'),

                'price' => $this->request('price'),

                'priceDiscount' => $this->request('priceDiscount'),

                'image' => $imageUpload,

                'image_resized' => $imageResizedUpload,

                'slug' => $this->adminCreateSlug($this->request('productName')),

                'stock' => $this->request('stock'),

                'categoryID' => $this->request('categoryID'),

                'subcategoryID' => $this->request('subcategoryID')

            ], ['productName', 'description', 'price', 'priceDiscount', 'image', 'image_resized', 'slug', 'stock', 'categoryID', 'subcategoryID']);


            if($updateProduct) {

                $updatedProduct = DB::find('products', ['productID' => $productID]);

                Session::put('updateProduct', 'Product <a href="' . $config['url']['path'] . 'admin-panel/product-edit/' . $updatedProduct->productID . '">' . $updatedProduct->productName . '</a> was successfully updated!');

                return $this->view('admin-panel/products/updatedProduct', compact('updatedProduct'));

            }

        }

    }

    public function adminEdit($productID = null) {

        $editProduct = DB::find('products', ['productID' => $productID]);

        $editCategory = DB::find('categories', ['categoryID' => $editProduct->categoryID]);

        $editSubcategory = DB::find('subcategories', ['subcategoryID' => $editProduct->subcategoryID]);

        if($editProduct) {

            return $this->view('admin-panel/products/edit', compact('editProduct', 'editCategory', 'editSubcategory'));

        }

    }

    public function adminDelete($productID = null) {

        $deleteProduct = DB::delete('products', ['productID' => $productID]);

        if($deleteProduct) {

            Session::put('deletedProduct', 'You successfully deleted product');

            Redirect::to('admin-panel/products-show');

        }
       
    }

    public function adminShowCategories() {

        $showCategories = DB::find('categories');

        return $this->view('admin-panel/categories/show', compact('showCategories'));

    }

    public function adminShowCategoryForm() {

            return $this->view('admin-panel/categories/create');

    }

    public function adminCreateCategory($categoryID = null) {

        if(!empty($_POST)) { 

            $createCategory = DB::create('categories', [

                'categoryName' => $this->request('categoryName'),

                'categorySlug' => $this->adminCreateSlug($this->request('categoryName'))

            ], ['categoryName', 'categorySlug']);

            $lastInsertId = Connection::lastInsertId();

            if($createCategory) {

                $newCategory = DB::find('categories', ['categoryID' => $lastInsertId]);

                Session::put('newCategory', $newCategory);

                Session::put('createdCategory', 'Your new category was successfully created!');

                Redirect::to('admin-panel/categories-show');

            }
        
        }

    }

    public function adminEditCategory($categoryID = null) {

        $editCategory = DB::find('categories', ['categoryID' => $categoryID]);

        return $this->view('admin-panel/categories/edit', compact('editCategory'));

    }

    public function adminUpdateCategory($categoryID = null) {
       
        if(!empty($_POST)) { 

            $sql = "UPDATE `categories` SET `categoryName` = :categoryName, `categorySlug` = :categorySlug WHERE `categoryID` = :categoryID";

            $updateCategory = DB::run($sql, ['categoryID' => $categoryID, 'categoryName' => $this->request('categoryName'), 'categorySlug' => $this->adminCreateSlug($this->request('categoryName'))]);                             
            
            if($updateCategory) {

                Session::put('updateCategory', 'Category successfully updated!');

                Redirect::to('admin-panel/categories-show');

            }

        }

    }

    public function adminDeleteCategory($categoryID = null) {

        $deleteCategory = DB::delete('categories', ['categoryID' => $categoryID]);

        if($deleteCategory) {

            $deleteSubCategory = DB::delete('subcategories', ['categoryID' => $categoryID]);

            $deleteProduct = DB::delete('products', ['categoryID' => $categoryID]);

            Session::put('deletedCategory', 'You successfully deleted product');

            Redirect::to('admin-panel/categories-show');

        }
       
    }

    public function adminShowSubCategoryForm() {

        $selectCategories = DB::find('categories');

        return $this->view('admin-panel/subcategories/create', compact('selectCategories'));

    }


    public function adminShowSubCategories() {

        $showSubCategories = DB::find('subcategories');

        return $this->view('admin-panel/subcategories/show', compact('showSubCategories'));

    }

    public function adminCreateSubCategory($subcategoryID = null) {

        if(!empty($_POST)) { 

            $createSubCategory = DB::create('subcategories', [

                'subCategoryName' => $this->request('subCategoryName'),

                'subcategorySlug' => $this->adminCreateSlug($this->request('subCategoryName')),

                'categoryID' => $this->request('categoryID')

            ], ['subCategoryName', 'categoryID', 'subcategorySlug']);

            $lastInsertId = Connection::lastInsertId();

            if($createSubCategory) {

                $newSubCategory = DB::find('subcategories', ['subcategoryID' => $lastInsertId]);

                Session::put('newSubCategory', $newSubCategory);

                Session::put('createdSubCategory', 'Your new subcategory was successfully created!');

                Redirect::to('admin-panel/subcategories-show');

            }
        
        }

    }

    public function adminUpdateSubCategory($subcategoryID = null) {
       
        if(!empty($_POST)) { 

            $updateSubCategory = DB::run("UPDATE `subcategories` SET `subcategoryName` = :subcategoryName, `subcategorySlug` = :subcategorySlug WHERE `subcategoryID` = :subcategoryID", 
                                ['subcategoryID' => $subcategoryID, 'subcategoryName' => $this->request('subcategoryName'), 'subcategorySlug' => $this->adminCreateSlug($this->request('subcategoryName'))]);

            if($updateSubCategory) {

                Session::put('updateCategory', 'Category successfully updated!');

                Redirect::to('admin-panel/subcategories-show');

            }

        }

    }


    public function adminEditSubCategory($subcategoryID = null) {

        $editSubCategory = DB::find('subcategories', ['subcategoryID' => $subcategoryID]);

        if($editSubCategory) {

            return $this->view('admin-panel/subcategories/edit', compact('editSubCategory'));

        }

    }

    public function adminDeleteSubCategory($subcategoryID = null) {

        $deleteSubCategory = DB::delete('subcategories', ['subcategoryID' => $subcategoryID]);

        if($deleteSubCategory) {

            $deleteProduct = DB::delete('products', ['subcategoryID' => $subcategoryID]);

            Session::put('deletedSubCategory', 'You successfully deleted product');

            Redirect::to('admin-panel/subcategories-show');

        }
       
    }


    public function adminShowOrders() {

            $sql = "SELECT * FROM `orders`"; 

            $sql .= "INNER JOIN `order_details` USING (orderID)";
        
            $sql .= "INNER JOIN `products` USING (productID)";
            
            $sql .= "INNER JOIN `customers` USING (customerID)";

            $sql .= "GROUP BY `customerID` DESC";

            $orders = DB::run($sql)->fetchAll();

        return $this->view('admin-panel/orders/show', compact('orders'));

    }


    public function adminShowOrderStatus($customerID = null) {

            $sql = "SELECT * FROM `orders`"; 

            $sql .= "INNER JOIN `order_details` USING (orderID)";
        
            $sql .= "INNER JOIN `products` USING (productID)";
            
            $sql .= "INNER JOIN `customers` USING (customerID)";

            $sql .= "WHERE `customerID` = :customerID";


        $orders = DB::run($sql, ['customerID' => $customerID])->fetchAll();


        return $this->view('admin-panel/orders/status', compact('orders'));

    }


    public function adminUpdateOrderStatus($customerID = null) {

        $config = Config::instance();

        $updateOrderStatus = DB::update('orders', ['customerID' => $customerID, 'status' => $this->request('orderStatus')], ['status']);

            if($updateOrderStatus) {

                $order = DB::find('orders', ['customerID' => $customerID]);

                $orderLink = '<a href="' . $config['url']['path'] . 'admin-panel/order-status/' . $customerID . '">No.  ' . mb_strtoupper(substr($order->orderNumber, 0, 8), 'UTF-8') . '</a>';

                Session::put('updateOrderStatus', 'You successfully update order status ' . $orderLink);

                Redirect::to('admin-panel/orders-show');

            }

    }




    public function adminShowCustomers() {

        $customers = DB::find('customers');

        return $this->view('admin-panel/customers/show', compact('customers'));

    }


    public function adminShowContacts() {

        $contacts = DB::find('contacts');

        return $this->view('admin-panel/contacts/show', compact('contacts'));

    }

    public function adminDeleteCustomer($customerID = null) {

        $deleteCustomer = DB::delete('customers', ['customerID' => $customerID]);

        if($deleteCustomer) {

            Session::put('deletedCustomer', 'You successfully deleted customer');

            Redirect::to('admin-panel/customers-show');

        }

    }


    public function adminReplyEmail() {

        if(!empty($_POST)) {

            $sql = "UPDATE `contacts` SET `reply` = :reply WHERE `contactID` = :contactID";

            $reply = DB::run($sql, ['reply' => $this->request('contact-reply'), 'contactID' => $this->request('contactID')]);

            require 'mail/mailer.php';

            //Recipients
            $mail->setFrom('onlineshop@example.com', 'Administrator');
            $mail->addAddress($this->request('email'), $this->request('name'));     
          
            // Content
            $mail->isHTML(true);  
                                            
            $mail->Subject = 'Online Shop - Reply Message';

            $body = $this->request('contact-reply');

            $mail->Body = $body;
           
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if($mail->send()) {

                Session::put('reply-email', 'You successfully reply to message.');

                Redirect::to('admin-panel/contacts-show');

            } else {

                echo 'Message not sent';

            }

        } 

    }


    public function adminReplyContact($contactID = null) {

        $contact = DB::find('contacts', ['contactID' => $contactID]);

        return $this->view('admin-panel/contacts/reply', compact('contact'));
    }


    public function adminDeleteContact($contactID = null) {

        $deleteContact = DB::delete('contacts', ['contactID' => $contactID]);

        if($deleteContact) {

            Session::put('deletedContact', 'You successfully deleted contact');

            Redirect::to('admin-panel/contacts-show');

        }

    }


    public function adminShowUsers() {

        $users = DB::find('users');

        return $this->view('admin-panel/users/show', compact('users'));
    }

    public function adminDeleteUser($id = null) {

        $user = DB::delete('users', ['id' => $id]);

        Redirect::to('admin-panel/users-show');

    }


    public function adminSignOut() {

        Session::remove('admin');

        return Redirect::to('admin-panel/sign-in');

    }

    public function adminCreateSlug($slugName = null) {

        $pattern = '/[^\-\s\pN\pL]+/u'; //allow only letters, numbers, hyphens, spaces

        $hypens = '/[\-\s]+/'; //remove duplicate hypens and spaces

        $slug = preg_replace($pattern, '', mb_strtolower($slugName, 'UTF-8'));

        $slug = preg_replace($hypens, '-', $slug);

        $slug = trim($slug, '-');


        return $slug;

    }


    public function adminShowNewsletter() {

        $newsletterEmail = DB::find('newsletter');

        return $this->view('admin-panel/newsletter/show', compact('newsletterEmail'));

    }

    public function adminNewsletterForm() {

        return $this->view('admin-panel/newsletter/send');

    }


    public function adminSendNewsletter($path, $extension) {

        $newsletter = DB::find('newsletter');

        require 'mail/mailer.php';

        //Recipients
        $mail->setFrom('onlineshop@example.com', 'Administrator');

        foreach($newsletter as $news) {

            $mail->ClearAllRecipients();

            $mail->addAddress($news->email); 

        // Newsletter pdf attachment
            $mail->addAttachment($path, 'latest-newsletter.' . $extension);
      
        // Content
            $mail->isHTML(true);  
                                            
            $mail->Subject = 'Online Shop - Newsletter';

            $body = '<h1>Greetings,</h1>';

            $body .= '<div style="margin-top: 20px;">Our latest newsletter. Enjoy! </div>';

            $body .= '<div style="margin-top: 20px;">Your Online Shop.</div>';

            $mail->Body = $body;
                
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if($mail->send()) {

                Session::put('newsletterSend', 'You successfully send newsletter to all active email recipients!');

                Redirect::to('admin-panel/newsletter');

            } else {
            
                echo 'Something went wrong with sending newsletter.';

            }

        }

    }

    public function adminFileUpload() {

       $error = [];

        if(isset($_FILES['newsletter'])) {

            $file = $_FILES['newsletter'];

            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            $extension = pathinfo($file_name, PATHINFO_EXTENSION);

            $allowTypes = ['pdf', 'docx', 'doc'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            if($file_size > 5242880) {

                $error[] = 'Exceeded file size limit. Only 5MB allowed.';

            } else {

                if(in_array($extension, $allowTypes) && empty($file_error) && $file_size <= 5242880) {

                    $file_name_uploaded = hash('sha512', $file_name) . '.' . $file_ext;
                    $file_folder = 'storage/' . $file_name_uploaded;
    
                    if(move_uploaded_file($file_tmp, $file_folder)) {
    
                       // return $file_folder;

                       return $this->adminSendNewsletter($file_folder, $file_ext);
    
                    } else {
    
                        $error[] = 'Failed to upload file.';
    
                    }
    
                } else {
    
                    $error[] = 'Check your file type. Allowed extensions are pdf, docx and doc!';
    
                }

            }

        } 

      return $this->view('admin-panel/newsletter/send', compact('error'));

    }

    public function adminNewsletterDelete($newsletterID) {

        $deleteNewsletter = DB::delete('newsletter', ['newsletterID' => $newsletterID]);

        if($deleteNewsletter) {

            Session::put('deletedNewsletter', 'You successfully deleted newsletter');

            Redirect::to('admin-panel/newsletter-show');

        }

    }

    public function adminProductsSearchResult() {

            $products = [];

            $validation = $this->form->validate($_POST, [

                'productName' => ['required' => true]

            ]);

            if(!$validation->errorHasFound()) {

                $sql = "SELECT * FROM `products` WHERE `productName` LIKE :productName LIMIT 6";

                $products = DB::run($sql, ['productName' => '%' . trim($this->request('productName')) . '%'])->fetchAll();

            } 

        return $this->view('admin-panel/products/products-search-result', compact('products'));
    
    }

    public function adminOrderSearchResult() {

            $sql = "SELECT * FROM `orders`"; 

            $sql .= "INNER JOIN `order_details` USING (orderID)";
                    
            $sql .= "INNER JOIN `customers` USING (customerID)";

            $sql .= "WHERE `name` LIKE :name OR `status` LIKE :status OR `orderNumber` LIKE :orderNumber OR `email` LIKE :email";

            $orders = DB::run($sql, ['name' => '%' . trim($this->request('name')) . '%', 'status' => '%' . trim($this->request('name')) . '%', 'orderNumber' => '%' . trim($this->request('name')) . '%', 'email' => '%' . trim($this->request('name')) . '%'])->fetchAll();


        return $this->view('admin-panel/orders/order-search-result', compact('orders'));

    }

    public function adminImageResize($resource_type, $width, $height) {

      //  $new_width = $width * 0.5;
      //  $new_height = $height * 0.5;

      //  $new_width = 170;
      //  $new_height = 170;
       
       $dimensions = 170;

       $ratio = $width / $height;

       if($ratio > 1) {

            $new_width = $dimensions;

            $new_height = $dimensions / $ratio;

       } else {

            $new_height = $dimensions;

            $new_width = $dimensions * $ratio;

       }

        $image_resize = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($image_resize, $resource_type, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        return $image_resize;

    }

}