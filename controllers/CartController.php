
<?php 


class CartController extends Controller implements Countable {


    protected $product;

    protected $cart;


    public function __construct($cart = 'cart') {

            if(empty($_SESSION[$cart])) {

                $_SESSION[$cart] = [];

            }

        $this->cart = $cart;

    }


    public function store($index, $value) {

        $_SESSION[$this->cart][$index] = $value;

    }


    public function get($index) {

            if($this->exists($index)) {

                return $_SESSION[$this->cart][$index];

            }

        return false;

    }


    public function exists($index) {

        return !empty($_SESSION[$this->cart][$index]);

    }



    public function all() {

        return $_SESSION[$this->cart];

    }



    public function remove($index) {


        if($this->exists($index)) {

           unset($_SESSION[$this->cart][$index]);

        }

        Redirect::to('cart');

    }


    public function clear() {

        unset($_SESSION[$this->cart]);

        return Redirect::to('cart');

    }


    public function count() {

        return count($this->all());

    }


    public function has($product) {

        return $this->exists($product->productID);

    }


    public function add() {

        $quantity = $this->request('quantity');

        $product = DB::find('products', ['productID' => $_POST['productID']]);

        if($this->has($product)) {

            $quantity = $this->getProduct($product)['quantity'] + $quantity;
            
        }

        if($quantity > 10) {

            $quantity = 10;

        }

        //Redirect::to('product/' . $product->slug);

        Redirect::to('cart');
        
        return $this->update($product, $quantity);

    }


    public function update($product, $quantity) {

        return $this->store($product->productID, [

            'productID' => (int) $product->productID,

            'quantity' => (int) $quantity

        ]);

/*
        if(!$this->product->find($product->id)->hasStock($quantity)) {

            throw new Exception('You have added the maximum of stock!');

        }


        if($quantity === 0) {

            return $this->removeProduct($product);

        }
*/


    }


    public function updateQuantity($productID/*$slug*/) {

        //$product = DB::find('products', ['slug' => $slug]);

        $product = DB::find('products', ['productID' => $productID]);

        $this->update($product, $this->request('quantity'));

        Redirect::to('cart');

    }


    public function getProduct($product) {

        return $this->get($product->productID);

    }


    public function allProducts() {

        $ids = [];

        $items = [];

        $in = [];

        foreach($this->all() as $product) {

            $ids[] = $product['productID'];

        }

        foreach($ids as $key => $value) {

            $key = ":productID" . $key;

            $in[] = $key;

            $params[$key] = $value;


        }

        $in = implode(', ', $in);


        if(!empty($params)) {

            $products = DB::run("SELECT * FROM `products` WHERE `productID` IN ($in)", $params)->fetchAll();

                foreach($products as $product) {

                    $product->quantity = $this->getProduct($product)['quantity'];

                    $items[] = $product;

                }

        }

        return $items;

    }

    public function subTotal() {

        $total = 0;

        foreach($this->allProducts() as $product) {
/*
            if($item->outOfStock()) {

                continue;

            }
*/

            $total = $total + $product->price * $product->quantity;

        }

        return $total;

    }


    public function refresh() {

        foreach($this->all() as $item) {

            if(!$item->hasStock($item->quantity)) {

                $this->update($item, $item->stock);

            } else if($item->hasStock(1) && $item->quantity === 0) {

                $this->update($item, 1);

            }

        }

    }

}