<?php

require_once('new_config.php');

class Database
{
    //leave a variable public
    public $connection;
    public $db;

    //Opening connection every time we access to file that includes Database class
    function __construct()
    {
      $this->db = $this->open_db_connection();
    }
    //Setting connection parameters
    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if($this->connection->connect_errno)
        {
            die('Database connection failed '.$this->connection->connect_error);
        }

        return $this->connection;
    }
    //Creating query
    public function query($sql)
    {
      $result = $this->db->query($sql);
      $this->confirm_query($result);

      return $result;
    }
    //Confirming query result
    private function confirm_query($result)
    {
      if(!$result)
      {
        die('Query failed'.$this->db->error);
      }
    }
    //Escaping string
    public function escape_string($string)
    {
      return $this->db->real_escape_string($string);
    }

    public function the_insert_id()
    {
      return mysqli_insert_id($this->db);
    }
}

$database = new Database();

?>
