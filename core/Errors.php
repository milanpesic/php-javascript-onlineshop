
<?php

class Errors {
    

    protected $errors = [];

    protected $rules = ['required', 'min', 'max', 'email', 'alnum', 'match', 'unique', 'token', 'exists', 'terms'];

    protected $messages = [

        'required' => 'This field is required',
        'min' => 'The {field} field must be a minimum of {value} length',
        'max' => 'The {field} field must be a maximum of {value} length',
        'email' => 'Email address is not valid.',
        'alnum' => 'The {field} field must contain only letters and numbers',
        'match' => 'This field must match a {value} field',
        'unique' => 'That {field} already exists.',
        'token' => 'The {field} field mismatch',
        'exists' => 'The requested {field} was not found',
        'terms' => 'You must agree to {field} before signing up'

    ];

    public function allErrors($key = null) {

        return !empty($this->errors[$key]) ? $this->errors[$key] : $this->errors;

    }


    public function oneError($key = null) {

        return !empty($this->allErrors($key)[0]) ? $this->allErrors($key)[0] : '';

    }




    public function errorHasFound() {

        return count($this->allErrors()) ? true : false;

    }


    public function addError($error, $key = null) {

        if(!empty($key)) {

            $this->errors[$key][] = $error;

        } else {

            $this->errors[] = $error;

        }
    }

}