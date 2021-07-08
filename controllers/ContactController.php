<?php

class ContactController extends Controller {


    protected $fillable = ['name', 'email', 'text'];

    protected $form;


    public function __construct() {

        $this->form = new Validator;

    }

    public function index() {

        return self::view('contact');

    }


    public function add() {

        if(!empty($_POST)) {

            $errors = $this->form->validate($_POST, [

                'name' => ['required' => true],
                'email' => ['required' => true, 'email' => true],
                'text' => ['required' => true, 'min' => 6, 'max' => 255]

            ]);

            if(!$errors->errorHasFound()) {

                $contact = DB::create('contacts', [

                    'name' => $this->request('name'),
                    'email' => $this->request('email'),
                    'text' => $this->request('text')

                ], $this->fillable);

                Session::put('contact-success', 'You have send your message successfully!');

                return Redirect::to('contact');

            }

        }

        return self::view('contact', compact('errors'));

    }

}