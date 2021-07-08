
<?php 


class Redirect {


    
    public static function to($path = null) {

        $config = Config::instance();

        return header("Location: " . $config['url']['path'] . $path);

    }

}