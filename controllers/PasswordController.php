
<?php 


class PasswordController extends Controller {


    protected $form;


    public function __construct() {

        $this->form = new Validator;

    }

    public function change() {

        return $this->view('change-password');

    }

    public function sendLink() {
 
        $config = Config::instance();

        $errors = [];

        if(!empty($_POST)) {

            $errors = $this->form->validate($_POST, [
                'email' => ['required' => true, 'email' => true, 'exists' => 'users'],
            ]);

            if(!$errors->errorHasFound()) {

                $user = DB::find('users', [

                    'email' => $this->request('email')

                ]);

                if($user) {

                    $csrf_token = DB::update('users', [

                        'id' => $user->id,
                        'csrf_token' => $this->request('csrf_token')

                    ], ['csrf_token']);

                    require 'mail/mailer.php';

                    $mail->setFrom('onlineshop@example.com', 'Admin');
                    $mail->addAddress($user->email, $user->name);

                    $mail->isHTML(true);  
                    $mail->Subject = 'Forgotten password';


                    $body = '<p>' . 'Hello ' . $user->name . '!' . '</p>';

                    $body .= '<p>We got a request for password resetting. You can click reset button bellow!</p>';
                    
                    $body .= '<button style="background: lightgrey;  font-size: 16px; padding: 5px; border: 1px solid lightgrey; border-radius: 5px; font-weight: bold;">
                                <a style="text-decoration: none; color: white;" href="' . $config['url']['path'] . 'reset/' . $this->request('csrf_token') . '">Reset</a>
                              </button>';

                    $mail->Body = $body;

                    if($mail->send()) {

                        Session::put('send-reset-link', 'Please check your email. <br> We send you a link for password reset.');
        
                        return Redirect::to('send-reset-link');

                    } else {
        
                        echo 'Something went wrong. Message not sent.';

                        exit;

                    }

                } 
                
            } 
            
        } 

        return $this->view('send-reset-link', compact('errors'));

    }


    public function reset($csrf_token = null) {

            $post = $_POST;

            $rules = [
                'password' => ['required' => true, 'min' => 6],
                'repeat' => ['match' => 'password']
            ];

            $errors = $this->form->validate($post, $rules);

            $user = DB::find('users', ['csrf_token' => $csrf_token]);

            if(!empty($post)) {

                if(!$errors->errorHasFound()) {

                $reset_password = DB::update('users', [

                    'id' => $user->id,
                    'password' => password_hash($this->request('password'), PASSWORD_DEFAULT, ['cost' => 10])
                    
                ], ['password']);

                if($reset_password) {

                    Session::put('reset-password', 'You can now login with a new password');

                    return Redirect::to('sign-in');

                }

            }

        }

        return $this->view('reset-password', compact('errors', 'csrf_token'));

    }

}