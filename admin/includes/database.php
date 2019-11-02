<?php

require_once('new_config.php');

class Database
{
    //leave a variable public
    public $connection;
    //Opening connection every time we access to file that includes Database class
    function __construct()
    {
      $this->open_db_connection();
    }
    //Setting connection parameters
    public function open_db_connection()
    {
        // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if($this->connection->connect_errno)
        {
            die('Database connection failed '.$this->connection->connect_error);
        }
    }
    //Creating query
    public function query($sql)
    {
      $result = $this->connection->query($sql);
      $this->confirm_query($result);

      return $result;
    }
    //Confirming query result
    private function confirm_query($result)
    {
      if(!$result)
      {
        die('Query failed'.$this->connection->error);
      }
    }
    //Escaping string
    public function escape_string($string)
    {
      $escaped_string = $this->connection->real_escape_string($string);

      return $escaped_string;
    }

    public function the_insert_id()
    {
      return $this->connection->insert_id;
    }
}

$database = new Database();

?>
