
<?php

class OrderController extends Controller {

    protected $cart;

    protected $form;



    public function __construct() {

        $this->form = new Validator;

        $this->cart = new CartController;

    }


    public function customerDetails() {

        if(!empty($this->cart->allProducts())) {

            return $this->view('customer-details');

        } else {

            Redirect::to('cart');

        }
       
    }

    public function order() {

        if(!empty($_POST)) {

            $errors = $this->form->validate($_POST, [

                    'name' => ['required' => true, 'min' => 6, 'max' => 50],
                    'email' => ['required' => true, 'email' => true],
                    'phone' => ['required' => true, 'max' => 50],
                    'address' => ['required' => true, 'min' => 6, 'max' => 100],
                    'city' => ['required' => true, 'max' => 50],
                    'postal' => ['required' => true, 'min' => 5],
                    'country' => ['required' => true, 'max' => 50],

            ]);

            if(!$errors->errorHasFound()) {

                try {
                    
                    $transaction = Connection::beginTransaction();

                    $customer = DB::create('customers', [

                        'name' => !empty(Session::set('user')) ? Session::set('user')->name : $this->request('name'),
    
                        'email' => !empty(Session::set('user')) ? Session::set('user')->email : $this->request('email'),

                        'phone' => $this->request('phone'),
    
                        'address' => $this->request('address'),
    
                        'city' => $this->request('city'),
    
                        'postal' => $this->request('postal'),

                        'country' => $this->request('country'),

                        'registered' => !empty(Session::set('user')) ? Session::set('user')->active : 0
    
                    ], ['name', 'email', 'phone', 'address', 'city', 'postal', 'country', 'registered']);


                    $customerID = Connection::lastInsertId();

    
                    $order = DB::create('orders', [

                        'orderNumber' => Token::generated('hash'),

                        'total' => $this->cart->subTotal() + 25,

                        'customerID' => $customerID

                    ], ['orderNumber', 'total', 'customerID']);
        

                    $orderID = Connection::lastInsertId();

                    foreach($this->cart->allProducts() as $product) { 

                        $orderDetails = DB::create('order_details', [

                            'orderID' => $orderID,

                            'productID' => $product->productID,

                            'quantity' => $product->quantity

                        ], ['orderID', 'productID', 'quantity']);

                    }

                        $transaction = Connection::commit();

                } catch (Exception $e) {

                    $transaction = Connection::rollBack();

                    echo "Failed: " . $e->getMessage();

                }

                  if($customer && $order && $orderDetails) {

                    $customer = DB::find('customers', ['customerID' => $customerID]);

                    Session::put('order-success', 'You place an order successfully!');

                    Session::put('invoice', $customer);
    
                    Redirect::to('order-summary');

                    //return $this->orderEmail($customer);

                }

            }

            return $this->view('customer-details', compact('errors'));

        }

    }

    public function orderSummary() {

        if(Session::has('invoice')) {

            $sql = "SELECT * FROM `orders`"; 

            $sql .= "INNER JOIN `order_details` USING (orderID)";
        
            $sql .= "INNER JOIN `products` USING (productID)";
            
            $sql .= "INNER JOIN `customers` USING (customerID)";

            $sql .= "WHERE `customerID` = :customerID";

            $orderSummary = DB::run($sql, ['customerID' => Session::get('invoice')->customerID])->fetchAll();

            $this->orderEmail($orderSummary);

            Redirect::to('home');

            //return $this->view('order-summary', compact('orderSummary'));

        } else {

            Redirect::to('cart');

        }

    }
/*
    public function orderEmail($customer) {

        require 'mail/mailer.php';

            //Recipients
            $mail->setFrom('onlineshop@example.com', 'Administrator');
            $mail->addAddress($customer->email, $customer->name);     // Add a recipient
          
            // Content
            $mail->isHTML(true);  
                                            // Set email format to HTML
            $mail->Subject = 'Online Shop - Order Details';

            $body = '<div style=""><h3>Order details</h3></div>';

            $body .= '<table style="text-align: left; border-collapse: collapse;">
            <tr style="background: lightgrey;">
                <th style="padding: 15px; border: 1px solid #ddd;">Product</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Name</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Description</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Price</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Quantity</th>
                <th style="padding: 15px; border: 1px solid #ddd;">SubTotal</th>
            </tr>';

            foreach($this->cart->allProducts() as $orderProduct) {

                $body  .=  '<tr>
                                <td style="padding: 15px; border: 1px solid #ddd;">' . '<img src="cid:pimage" style="width: 80px; height: 60px;">' . '</td>
                                <td style="padding: 15px; border: 1px solid #ddd;">' . $orderProduct->productName . '</td>
                                <td style="padding: 15px; border: 1px solid #ddd;">' . $orderProduct->slug . '</td>
                                <td style="padding: 15px; border: 1px solid #ddd;">' . '&euro; ' . $orderProduct->price . '</td>
                                <td style="padding: 15px; border: 1px solid #ddd;">' . $orderProduct->quantity . '</td>
                                <td style="padding: 15px; border: 1px solid #ddd;">' . '&euro; ' . number_format($orderProduct->price * $orderProduct->quantity, 2) . '</td>
                          </tr>';
                         
                }
                
            $body .= '</table>';

            $body .= '<div><h3>SubTotal: <span style="font-weight: bold;"> &euro; ' . number_format($this->cart->subTotal(), 2) . '</span></h3></div>';

            $body .= '<div><h3>Shipping: <span style="font-weight: bold;"> &euro; ' . 25 . '</span></h3></div>';

            $body .= '<div><h3>Total: <span style="color:red; font-weight: bold;"> &euro; ' . number_format($this->cart->subTotal() + 25, 2) . '</span></h3></div>';

            $mail->Body = $body;

            $mail->addEmbeddedImage('public/images/no-image.png', 'pimage');

            $mail->addStringAttachment($this->createPDF($body), 'order-summary.pdf');
           
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if($mail->send()) {

                echo 'Message has been sent';

            } else {

                echo 'Message not sent';

            }
    
        return $this->cart->clear();

    }
*/

    public function createPDF($order) {

        $mpdf = new \Mpdf\Mpdf();

        // Write some HTML code:
        $mpdf->SetHeader('Online Shop');
        $mpdf->SetFooter('Online Shop');
        $mpdf->showImageErrors = true;
        $mpdf->WriteHTML($order);

        // Output a PDF file directly to the browser
        return $mpdf->Output("","S");

    }


    public function orderEmail($orderSummary) {

        require 'mail/mailer.php';

            //Recipients
            $mail->setFrom('onlineshop@example.com', 'Administrator');
            $mail->addAddress($orderSummary[0]->email, $orderSummary[0]->name);     // Add a recipient
          
            // Content
            $mail->isHTML(true);  
                                            // Set email format to HTML
            $mail->Subject = 'Online Shop - Order Details';

            $body = '<div style="margin-top: 50px;"><h3>Order Summary</h3></div>';

            $date = new DateTime($orderSummary[0]->created_at); 

            $body .= '<div style="margin-top: 50px; text-align: right;">Order Date</div>';

            $body .= '<div style="text-align: right; color: grey">' . $date->format('H:i a, d M Y') . '</div>';

            $body .= '<hr>';

            $body .= '<table style="margin-top: 50px; width:100%;">
            <tr>
                <th style="text-align: left;">Shipping To</th>
                <th style="text-align: right;">Payment To</th>
            </tr>

            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->name . '</td><td style="text-align: right;">Online Shop</td>
            </tr>

            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->email . '</td><td style="text-align: right;">online.shop@example.com</td>
            </tr>
        
            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->phone . '</td><td style="text-align: right;">061.234.5678</td>
            </tr>

            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->address . '</td><td style="text-align: right;">Example 12</td>
            </tr>

            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->city . '</td><td style="text-align: right;">Leskovac</td>
            </tr>

            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->postal . '</td><td style="text-align: right;">16000</td>
            </tr>

            <tr>
                <td style="text-align: left;">' . $orderSummary[0]->country . '</td><td style="text-align: right;">Serbia</td>
            </tr>

            </table>';

            $body .= '<hr>';

            $body .= '<table style="margin-top: 50px; width:100%;">

                    <tr>

                        <th style="text-align: left;">Image</th> 

                        <th style="text-align: center;">Description</th> 

                        <th style="text-align: center;">Quantity</th> 

                        <th style="text-align: right;">Price</th> 

                        <th style="text-align: right;">Amount</th> 

                    </tr>';

            foreach($orderSummary as $order) {

                          $body  .=  '<tr>
                                <td style="text-align: left;">' . '<img src="' . $order->image . '" style="width: 80px; height: 60px; border: 1px solid #ddd;"></td>
                                <td style="text-align: center;">' . $order->productName . '</td>
                                <td style="text-align: center;">' . $order->quantity . '</td>
                                <td style="text-align: right;">' . '&euro; ' . $order->price . '</td>
                                <td style="text-align: right;">' . '&euro; ' . number_format($order->price * $order->quantity, 2) . '</td>
                          </tr>';

                            $image = file_get_contents($order->image);

                            $mail->addStringEmbeddedImage($image, $order->image, '', 'base64', 'image/*');

            }
                
            $body .= '</table>';

            $body .= '<hr>';

            $body .= '<table style="margin-top: 50px; width:100%;">
                    
                        <tr>
                            <th style="text-align: right;">SubTotal:</th> <td style="text-align: right; width: 15%;">&euro; ' . number_format($order->total - 25, 2) . '</td>
                        </tr>

                        <tr>
                            <th style="text-align: right;">Shipping:</th> <td style="text-align: right; width: 15%;">&euro; ' . number_format(25, 2) . '</td>
                        </tr>
                        
                        <tr>
                            <th style="text-align: right;">Total:</th> <td style="text-align: right; color: red; width: 15%;">&euro; ' . number_format($order->total, 2) . '</td>
                        </tr>

                </table>';

            $mail->Body = $body;

            $mail->addStringAttachment($this->createPDF($body), 'order-summary.pdf');
           
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if($mail->send()) {

                echo 'Message has been sent';

            } else {

                echo 'Message not sent';

            }
    
        return $this->cart->clear();

    }

}