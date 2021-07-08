
<?php 


class ProfileController extends Controller {



    protected $form;

   



    public function __construct() {

        $this->form = new Validator;

    }


    public function profile() {

        $current = DB::find('users', ['id' => Session::set('user')->id]);

        return $this->view('update-profile', compact('current'));

    }


    public function updateProfile() {

        $errors = [];

            if(!empty($_POST)) {

                $errors = $this->form->validate($_POST, [
            
                    'username' => ['required' => true, 'min' => 3, 'max' => 50],
                    'name' => ['required' => true, 'min' => 3, 'max' => 50],
                    'password' => ['required' => true, 'min' => 6, 'max' => 255],
                    'newPassword' => ['required' => true, 'min' => 6, 'max' => 255],
                    'repeatPassword' => ['required' => true, 'min' => 6, 'max' => 255, 'match' => 'newPassword'],
                    'csrf' => ['csrf' => true]

                ]);

                if(!$errors->errorHasFound()) {

                    $params = [

                        'id' => Session::set('user')->id,
                        'username' => $this->request('username'),
                        'name' => $this->request('name'),
                        'password' => password_hash($this->request('newPassword'), PASSWORD_DEFAULT, ['cost' => 10]),

                    ];

                    $fillable = ['username', 'name', 'password'];

                    $user = DB::find('users', ['id' => Session::set('user')->id]);

                    if($user) {

                        if(password_verify($this->request('password'), $user->password)) {
        
                            $update = DB::update('users', $params, $fillable);

                            if($update) {
        
                                Session::put('user', DB::find('users', ['id' => Session::set('user')->id]));
        
                                Session::put('update', 'You successfully update your profile!');
            
                                return Redirect::to('update-profile');
        
                            }
        
                        } else {

                            Session::put('notUpdated', 'Something went wrong. Check your current password again!');
    
                        } 
        
                    } 

                }

        }

        return $this->view('update-profile', compact('errors'));

    }


    public function shoppingHistory() {

        $orderSummary = [];

        $sql = "SELECT * FROM `orders`"; 

        $sql .= "INNER JOIN `order_details` USING (orderID)";
    
        $sql .= "INNER JOIN `products` USING (productID)";
        
        $sql .= "INNER JOIN `customers` USING (customerID)";

        $sql .= "WHERE `customerID` = :customerID";

        if(Session::has('user')) {

            $customer = DB::findAll('customers', ['email' => Session::set('user')->email]);

        } 

        if(!empty($customer)) {

            foreach($customer as $cust) {

                $orderSummary[] = DB::run($sql, ['customerID' => $cust->customerID])->fetchAll();

            }

        } 

        return $this->view('shopping-history', compact('orderSummary'));

    }

}