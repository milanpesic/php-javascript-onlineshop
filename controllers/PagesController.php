

<?php 


class PagesController extends Controller {


    public function home() {

        return $this->view('home');

    }

    public function about() {

        return $this->view('about');

    }

    public function contact() {

        return $this->view('contact');

    }

    public function cart() {

        return $this->view('cart');

    }


    public function error404() {

        return $this->view('404');

    }


    public function adminSignInForm() {

        if(Session::has('admin')) {

            Redirect::to('admin-panel');

        } else {

            return $this->view('admin-panel/sign-in');

        }
        
        
    }

}