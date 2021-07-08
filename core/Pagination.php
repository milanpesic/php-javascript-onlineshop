
<?php


class Pagination {


    protected $limit;

    protected $offset;

    protected $total;



    public function limit($limit) {

        $this->limit = $limit;

    }


    public function offset($offset) {

        $page = !empty($_POST['page']) && $_POST['page'] > 1 ? $_POST['page'] : 1;

        $this->offset = ($page - 1) * $this->limit;

    }


    public function total($total) {

        $this->total = count($total);

    }

    public function pages($pages) {

        $this->pages = ceil($this->total / $this->limit);

    }

    /*

    $limit = 6;

    $page = !empty($_POST['page']) && $_POST['page'] > 1 ? $_POST['page'] : 1;

    $offset = ($page - 1) * $limit;

    //$pagination = new Pagination;

    $products = DB::find('products');

    $total = count($products);

    $pages = ceil($total / $limit);

    $products = DB::find('products', ['offset' => $offset, 'limit' => $limit]);

    return self::view('products', compact('products', 'pages'));

*/

}