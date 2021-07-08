
<?php

class Validator extends Errors {


    public function validate($post, $rules) {

        foreach($post as $post_key => $post_value) {

            if(array_key_exists($post_key, $rules)) {

                foreach($rules[$post_key] as $rule => $rule_value) {

                    if(in_array($rule, $this->rules)) {

                        if(!call_user_func_array([$this, $rule], [$post_key, $post_value, $rule_value])) {

                            $this->addError(strtr($this->messages[$rule], ['{field}' => $post_key, '{value}' => $rule_value]), $post_key);

                        }

                    } 

                }

            } 

        }

        return $this;

    }


    public function required($post_key, $post_value, $rule_value) {

        return !empty(trim($post_value));
            
    }


    public function min($post_key, $post_value, $rule_value) {

        return mb_strlen($post_value) >= $rule_value;

    }


    public function max($post_key, $post_value, $rule_value) {

        return mb_strlen($post_value) <= $rule_value;
        
    }


    public function email($post_key, $post_value, $rule_value) {

        return filter_var($post_value, FILTER_VALIDATE_EMAIL);

    }


    public function alnum($post_key, $post_value, $rule_value) {

        return ctype_alnum($post_value);
        
    }


    public function match($post_key, $post_value, $rule_value) {

        return $post_value === $_POST[$rule_value];

    }


    public function unique($post_key, $post_value, $rule_value) {

        return !DB::find($rule_value, [$post_key => $post_value]);

    }

    public function token($post_key, $post_value, $rule_value) {

        return Token::check($post_key);

    }

    public function exists($post_key, $post_value, $rule_value) {

        return DB::find($rule_value, [$post_key => $post_value]);

    }

    public function terms($post_key, $post_value, $rule_value) {

        return $post_value === 'yes' ? true : false;

    }

}