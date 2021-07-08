<?php 

class DB {


    public static function find($table, $params = []) {

        $sql = "SELECT * FROM `{$table}`";

            if(empty($params)) {

                if($table === 'products') {

                    $sql .= " ORDER BY `productID` DESC";

                }

                return self::run($sql, $params)->fetchAll();

            } elseif(isset($params['offset']) && isset($params['limit'])) {

                $sql .= " LIMIT :offset, :limit";

                return self::run($sql, $params)->fetchAll();
            
            } else {

                foreach($params as $key => $value) {
                   
                    $sql .= " WHERE " . "`" . str_replace("`", "``", $key) . "` = :" . $key;

                }

                return self::run($sql, $params)->fetch();

            }

    }


    public function findAll($table, $params = []) {

        $sql = "SELECT * FROM `{$table}`";

        $key = array_key_first($params);

        $sql .= " WHERE " . "`" . str_replace("`", "``", $key) . "` = :" . $key;

        if(isset($params['offset']) && isset($params['limit'])) {

            $sql .= " LIMIT :offset, :limit";

        }

        return self::run($sql, $params)->fetchAll();

    }


    public static function verify($table, $params = []) {

        $sql = "SELECT * FROM `{$table}` WHERE `username` = :username OR `email` = :email";

        $user = self::run($sql, ['username' => $params['username'], 'email' => $params['username']])->fetch();

        //$user = self::find($table, ['username' => $params['username']]);

            if($user) {

                if(password_verify($params['password'], $user->password)) {

                    return $user;

                }

            } 

        return false;
        
    }


    public static function create($table, $params = [], $fillable = []) {

            $sql = "INSERT INTO `{$table}`";

            $sql .= " (" . "`" . implode("`, `", $fillable) . "`";

            $sql .= ") VALUES (";

            $sql .= ':' .  implode(', :', $fillable) . ")";

        return self::run($sql, $params);

    }


    public static function update($table, $params = [], $fillable = []) {

        $sql = "UPDATE `{$table}` SET ";

        $set = [];

        foreach($fillable as $key) {

            $set[] .= "`" . str_replace("`", "``", $key) . "` = :" . $key;

        }

        $sql .= implode(', ', $set);

        $where = array_key_first($params);

        $sql .= " WHERE `$where` = :$where";

        return self::run($sql, $params);

    }


    public static function delete($table, $params = []) {

        $sql = "DELETE FROM `{$table}`";

        foreach($params as $key => $value) {
                   
            $sql .= " WHERE " . "`" . str_replace("`", "``", $key) . "` = :" . $key;

        }

        return self::run($sql, $params);

    }



    public static function run($sql, $params = [])  {

        $stmt = Connection::prepare($sql);

        $stmt->execute($params);

        return $stmt; 

    }

}