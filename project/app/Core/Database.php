<?php


namespace App\Core;


class Database
{
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    private static $connection;

    public static function getConnection()
    {
        if(empty(self::$connection))
        {
            $db = new Database();
            self::$connection = $db->connect();
        }

        return self::$connection;


    }

    public function connect()
    {
        $this->host = env('DB_HOST', 'mariadb');
        $this->username = env('DB_USERNAME', 'root');
        $this->password = env('DB_PASSWORD', 'secret');
        $this->dbname = env('DB_NAME', 'project');
        $this->charset = 'utf8mb4';

        try {
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset."";
            $pdo = new \PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        }catch (\Exception $e) {
            die('Connection failed: '.$e->getMessage());
        }

        return $pdo;
    }


    public static function insert($table, $values) {

        $insert_sql_values = array_fill(0, count($values), '?' );
        $insert_sql_fields = array_keys($values);
        $bind_params = array_values($values);

        $sql =  "INSERT INTO ".$table." (".implode(', ', $insert_sql_fields).") VALUES (".implode(', ', $insert_sql_values).")";

        $connection = self::getConnection();
        $query= $connection->prepare($sql);
        $query->execute($bind_params);

        return $connection->lastInsertId();;

    }

    public static function update($table, $values, $where, $whereValues = [])
    {
        $whereValues = (!is_array($whereValues)) ? [$whereValues]:$whereValues;
        $update_values = array_values($values);
        $insert_sql_fields = array_map(function($val) { return $val.' = ?'; }, array_keys($values));

        $where = ( empty(trim($where)) ) ? '1': $where;

        $bind_params = array_merge($update_values, $whereValues);

        $sql =  "UPDATE ".$table." SET ".implode(', ', $insert_sql_fields)." WHERE ".$where;

        $connection = self::getConnection();
        $query= $connection->prepare($sql);
        $query->execute($bind_params);

        return true;

    }

    public static function getRows($query, $whereValues)
    {
        $connection = self::getConnection();
        $query= $connection->prepare($query);
        $query->execute($whereValues);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public static function getRecord($query, $whereValues)
    {
        $data = self::getRows($query, $whereValues);
        return $data[0]??[];
    }

    public static function getUser($id)
    {
        $user = self::getRecord('select * from users where id = ?', [$id]);
        return (empty($user))?null:$user;
    }

}