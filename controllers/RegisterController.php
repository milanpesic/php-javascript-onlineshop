
<?php

class RegisterController extends Controller {


    protected $form;


    public function __construct() {

        $this->form = new Validator;
      
            if($this->isSignedIn()) {

                Redirect::to('products');

            }

    }


    public function signInForm() {

        return $this->view('sign-in');

    }


    public function signUpForm() {

        return $this->view('sign-up');

    }


    public function signIn() {

        if(!empty($_POST)) {

                $errors = $this->form->validate($_POST, [

                    'username' => ['required' => true],
                    'password' => ['required' => true],
                    'csrf_token' => ['token' => true]

                ]);

                if(!$errors->errorHasFound()) {

                    $user = DB::verify('users', [
                        'username' => $this->request('username'),
                        'password' => $this->request('password')
                    ]);

                    if($user) {

                        if(!empty($user->active)) {

                            Session::put('user', $user);

                            Redirect::to('products');

                            return $this->cookie_set();

                        } else {

                            Session::put('accountNotActivated', 'Your account is not activated. Please check your email!');

                        }

                    } else {

                        Session::put('warning', 'Username or password is not correct!');

                    }

                }

                return $this->view('sign-in', compact('errors'));

        }
        
    }


    public function signUp() {

        $config = Config::instance();

        if(!empty($_POST)) {

                $errors = $this->form->validate($_POST, [
                            'username' => ['required' => true, 'min' => 3, 'max' => 20, 'alnum' => true, 'unique' => 'users'],
                            'email' => ['required' => true, 'max' => 255, 'email' => true, 'unique' => 'users'],
                            'password' => ['required' => true, 'min' => 6],
                            'repeatPassword' => ['match' => 'password'],
                            'name' => ['required' => true, 'min' => 3, 'max' => 50],
                            'csrf_token' => ['token' => true],
                            'terms' => ['terms' => true]
                ]);


                if(!$errors->errorHasFound()) {

                        $userCreate = DB::create('users', [
                            'username' => self::request('username'),
                            'email' => self::request('email'),
                            'password' => password_hash(self::request('password'), PASSWORD_DEFAULT, ['cost' => 10]),
                            'name' => self::request('name'),
                            'csrf_token' => self::request('csrf_token'),
                        ], ['username', 'email', 'password', 'name', 'csrf_token']);


                        if($userCreate) {

                            $user = DB::find('users', ['email' => self::request('email')]);

                            require 'mail/mailer.php';
    
                            $mail->setFrom('onlineshop@example.com', 'Admin');
                            $mail->addAddress($user->email, $user->name);
        
                            $mail->isHTML(true);  
                            $mail->Subject = 'Activate your account';
        
                            $body = '<p>' . 'Hello ' . $user->name . '!' . '</p>';
        
                            $body .= '<p>We are sending you a link for account activation. You can click activate button bellow!</p>';
                            
                            $body .= '<button style="background: lightgrey;  font-size: 16px; padding: 5px; border: 1px solid lightgrey; border-radius: 5px; font-weight: bold;">
                                        <a style="text-decoration: none; color: white;" href="' . $config['url']['path'] . 'activate-account/' . $this->request('csrf_token') . '">Activate</a>
                                      </button>';
        
                            $mail->Body = $body;
        
                            if($mail->send()) {
        
                                Session::put('success', 'Please check your email. <br> We send you activation link.');
                
                                return Redirect::to('sign-in');
        
                            } else {
                
                                echo 'Something went wrong. Message not sent.';
        
                                exit;
        
                            }    

                        }
                       
                }

                return $this->view('sign-up', compact('errors'));

        } 

    }


    public function activateAccount($activate = null) {

        if(!empty($activate)) {

            $user = DB::find('users', ['csrf_token' => $activate]);

            if($user) {

                $update = DB::update('users', ['id' => $user->id, 'active' => 1], ['active']);

                Session::put('activated', '<b>Your account is now activated. Sign in to start shopping.<b>');

                Redirect::to('sign-in');

            } else {

                exit('Somethnig went wrong with account activation!');

            }

        } else {

            Redirect::to('404');

        } 

    }


    public function signOut() {

        $cookie_session_delete = DB::delete('user_session', ['user_id' => Session::set('user')->id]);

        Cookie::remove('cookie_token');

        Session::remove('user');

        Session::remove('cart');

        return Redirect::to('sign-in');

    }


    public function isSignedIn() {

        return Session::has('user') ? true : false;

    }


    public function cookie_set() {

        $remember = ($this->request('remember') === 'on') ? true : false;

        if($remember && Session::set('user')) {

            $cookie_token = $this->request('cookie_token');

            $cookie_token_check = DB::find('user_session', ['user_id' => Session::set('user')->id]);

            if(!$cookie_token_check) {

                $cookie_token_create = DB::create('user_session', [
                    'user_id' => Session::set('user')->id,
                    'cookie_token' => $cookie_token
                ], ['user_id', 'cookie_token']);

            } else {

                $cookie_token = $cookie_token_check->cookie_token;

            }

            Cookie::put('cookie_token', $cookie_token, 30);

        }

    }
    
}