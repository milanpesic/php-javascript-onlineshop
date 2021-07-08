

<?php 


class SearchNewsletterController extends Controller {

    protected $form;

    public function __construct() {

        $this->form = new Validator;

    }

    public function searchResult() {

            $products = [];

            $validation = $this->form->validate($_POST, [

                'productName' => ['required' => true]

            ]);

            if(!$validation->errorHasFound()) {

                $sql = "SELECT * FROM `products` WHERE `productName` LIKE :productName LIMIT 6";

                $products = DB::run($sql, ['productName' => '%' . trim($this->request('productName')) . '%'])->fetchAll();

            } 

        return $this->view('search-result', compact('products'));
        
    }


    public function newsletter() {

        $config = Config::instance();

        $response = [];

        $validation = $this->form->validate($_POST, [

            'email' => ['required' => true, 'email' => true, 'unique' => 'newsletter'],
            'csrf_token' => ['required' => true]

        ]);


        if(!$validation->errorHasFound()) {

            $newsLetterEmail = DB::create('newsletter', [

                'email' => $_POST['email'],
                'csrf_token' => $_POST['csrf_token']
                
            ], ['email', 'csrf_token']);


            if($newsLetterEmail) {

                require 'mail/mailer.php';

                //Recipients
                $mail->setFrom('onlineshop@example.com', 'Administrator');
                $mail->addAddress($_POST['email']);     
              
                // Content
                $mail->isHTML(true);  
                                                
                $mail->Subject = 'Online Shop - Activation Link';
        
                $body = '<h1>Greetings,</h1>';
        
                $body .= '<div style="margin-top: 20px;">We have received a request that you would like to receive newsletters from Online Shop.</div> 
                          <div style="margin-bottom: 20px;">Please confirm your email bellow.</div>';
        
                $body .= '<button style="background: lightgrey;  font-size: 16px; padding: 5px; border: 1px solid lightgrey; border-radius: 5px; font-weight: bold;">
                               <a style="text-decoration: none; color: white;" href="' . $config['url']['path'] . 'newsletter-activate/' . $this->request('csrf_token') . '">Activate</a>
                          </button>';
        
                $body .= '<div style="margin-top: 60px;">Thank you, your Online Shop!</div>';
        
                $mail->Body = $body;
               
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
                if($mail->send()) {
                    
                    $response['message'] = 'Thank you for your subscription! We sent you activation link.';
                    $response['token'] = Token::generated('token');
                    $response['success'] = true;

                    echo json_encode($response);

                } else {
        
                    echo 'Activation link not sent';
        
                }

            }

        } else {

            $response['message'] = $validation->oneError('email');
            $response['token'] = Token::generated('token');
            $response['success'] = false;

            echo json_encode($response);

        }
        
    }


    public function newsletterActivation($csrf_token = null) {

        $newsletterActivate = DB::update('newsletter', [

            'csrf_token' => $csrf_token,
            'active' => 1
            
        ], ['active']);
    
            if($newsletterActivate) {

                Session::put('newsletter-activate', 'You successfully activate your newsletter email.');

                Redirect::to('home');

            }
    
    }

}