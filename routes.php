<?php


##########################
#     PagesController    #
##########################


Router::get('', 'PagesController@home');

Router::get('home', 'PagesController@home');

Router::get('about', 'PagesController@about');

Router::get('contact', 'PagesController@contact');

Router::get('cart', 'PagesController@cart');

Router::get('404', 'PagesController@error404');

Router::get('admin-panel/sign-in', 'PagesController@adminSignInForm');



##########################
#   ProductsController   #
##########################


Router::get('products', 'ProductsController@showDiscountProducts');

Router::get('products/{slug}', 'ProductsController@showAll');

Router::get('products/{slug}{sort}', 'ProductsController@showAll');

Router::get('products/{slug}/{slug}', 'ProductsController@showAll');

Router::get('products/{slug}/{slug}{sort}', 'ProductsController@showAll');

Router::get('products/{slug}/{slug}/{id}', 'ProductsController@showAll');

Router::get('products/{slug}/{id}', 'ProductsController@showAll');

Router::get('product/{slug}', 'ProductsController@showOne');



##########################
#   SearchNewsletterController   #
##########################


Router::get('newsletter-activate/{url}', 'SearchNewsletterController@newsletterActivation');

Router::post('search-result', 'SearchNewsletterController@searchResult');

Router::post('newsletter', 'SearchNewsletterController@newsletter');



##########################
#   RegisterController   #
##########################


Router::get('sign-in', 'RegisterController@signInForm');

Router::get('sign-up', 'RegisterController@signUpForm');

Router::get('sign-out', 'RegisterController@signOut');

Router::post('sign-up', 'RegisterController@signUp');

Router::post('sign-in', 'RegisterController@signIn');

Router::get('activate-account/{url}', 'RegisterController@activateAccount');


##########################
#   ContactController   #
##########################



Router::post('contact', 'ContactController@add');


##########################
#      CartController    #
##########################


Router::get('cart/remove/{id}', 'CartController@remove');

Router::get('cart/clear', 'CartController@clear');

Router::post('cart/update/{slug}', 'CartController@updateQuantity');

Router::post('cart/add', 'CartController@add');


##########################
#     OrderController    #
##########################


Router::get('order-email', 'OrderController@orderEmail');

Router::get('customer-details', 'OrderController@customerDetails');

Router::post('order', 'OrderController@order');

Router::get('order-summary', 'OrderController@orderSummary');

Router::get('create-pdf', 'OrderController@createPDF');




##########################
#   PasswordController   #
##########################


Router::get('send-reset-link', 'PasswordController@sendLink');

Router::get('reset/{url}', 'PasswordController@reset');

Router::post('send-reset-link', 'PasswordController@sendLink');

Router::post('reset-password/{url}', 'PasswordController@reset');


##########################
#    ProfileController   #
##########################


Router::get('update-profile', 'ProfileController@profile');

Router::get('shopping-history', 'ProfileController@shoppingHistory');

Router::post('update-profile', 'ProfileController@updateProfile');


############################
#       AdminController    #
############################


Router::get('admin-panel', 'AdminController@adminPanel');

Router::get('admin-panel/sign-out', 'AdminController@adminSignOut');

Router::post('admin-panel/sign-in', 'AdminController@adminSignIn');


############################
#       AdminCRUD    #
############################


Router::get('admin-panel/products-show', 'AdminController@adminShowProducts');

Router::get('admin-panel/product-create', 'AdminController@adminShowProductForm');

Router::get('admin-panel/product-edit/{id}', 'AdminController@adminEdit');

Router::get('admin-panel/product-preview/{id}', 'AdminController@adminProductPreview');

Router::post('admin-panel/product-preview/{id}', 'AdminController@adminUpdate');

Router::get('admin-panel/updated-product', 'AdminController@adminUpdate');

Router::post('admin-panel/product-create', 'AdminController@adminCreate');

Router::get('admin-panel/product-delete/{id}', 'AdminController@adminDelete');


Router::get('admin-panel/categories-show', 'AdminController@adminShowCategories');

Router::get('admin-panel/category-create', 'AdminController@adminShowCategoryForm');

Router::get('admin-panel/category-edit/{id}', 'AdminController@adminEditCategory');

Router::post('admin-panel/category-create', 'AdminController@adminCreateCategory');

Router::post('admin-panel/category-update/{id}', 'AdminController@adminUpdateCategory');

Router::get('admin-panel/category-delete/{id}', 'AdminController@adminDeleteCategory');


Router::get('admin-panel/subcategories-show', 'AdminController@adminShowSubCategories');

Router::get('admin-panel/subcategory-create', 'AdminController@adminShowSubCategoryForm');

Router::post('admin-panel/subcategory-create', 'AdminController@adminCreateSubCategory');

Router::get('admin-panel/subcategory-edit/{id}', 'AdminController@adminEditSubCategory');

Router::post('admin-panel/subcategory-update/{id}', 'AdminController@adminUpdateSubCategory');

Router::get('admin-panel/subcategory-delete/{id}', 'AdminController@adminDeleteSubCategory');


Router::get('admin-panel/orders-show', 'AdminController@adminShowOrders');

Router::get('admin-panel/order-status/{id}', 'AdminController@adminShowOrderStatus');

Router::post('admin-panel/order-status/{id}', 'AdminController@adminUpdateOrderStatus');

Router::get('admin-panel/order-delete/{id}', 'AdminController@adminDeleteOrder');


Router::get('admin-panel/contacts-show', 'AdminController@adminShowContacts');

Router::get('admin-panel/contact-reply/{id}', 'AdminController@adminReplyContact');

Router::post('admin-panel/reply-email', 'AdminController@adminReplyEmail');

Router::get('admin-panel/contact-delete/{id}', 'AdminController@adminDeleteContact');


Router::get('admin-panel/customers-show', 'AdminController@adminShowCustomers');

Router::get('admin-panel/customer-delete/{id}', 'AdminController@adminDeleteCustomer');


Router::get('admin-panel/users-show', 'AdminController@adminShowUsers');

Router::get('admin-panel/user-delete/{id}', 'AdminController@adminDeleteUser');


Router::get('admin-panel/newsletter-show', 'AdminController@adminShowNewsletter');

Router::get('admin-panel/newsletter', 'AdminController@adminNewsletterForm');

Router::get('admin-panel/newsletter-activation-link/{id}', 'AdminController@adminSendNewsletterActivationLink');

Router::post('admin-panel/newsletter-send', 'AdminController@adminFileUpload');

Router::get('admin-panel/newsletter-delete/{id}', 'AdminController@adminNewsletterDelete');




Router::post('admin-panel/products-search-result', 'AdminController@adminProductsSearchResult');

Router::post('admin-panel/order-search-result', 'AdminController@adminOrderSearchResult');








###########################



Router::execute();