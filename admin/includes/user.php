<?php
class User
{
  protected static $db_table = 'users';
  protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  //Method for selecting all users
  public static function find_all_users()
  {
    return self::find_this_query("SELECT * FROM users");
  }

  //Method for selecting user by spectific id
  public static function find_user_by_id($user_id)
  {
    global $database;
    $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");

    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

  //Method for creating some query
  public static function find_this_query($sql)
  {
    global $database;
    $result_set = $database->query($sql);
    $the_object_array = array();
    while($row = mysqli_fetch_array($result_set))
    {
      $the_object_array[] = self::instantiation($row);
    }

    return $the_object_array;
  }

  //Method for verifying user
  public static function verify_user($username, $password)
  {
    global $database;

    $username = $database->escape_string($username);
    $password = $database->escape_string($password);
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_this_query($sql);

    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

  //method for instantiate user
  public static function instantiation($the_record)
  {
    $the_object = new self;
    foreach($the_record as $the_attribute => $value)
    {
      if($the_object->has_the_attribute($the_attribute))
      {
        $the_object->$the_attribute = $value;
      }
    }

    return $the_object;
  }

  //Checking if some object has the attribute
  private function has_the_attribute($the_attribute)
  {
    $object_properties = get_object_vars($this);

    return array_key_exists($the_attribute, $object_properties);
  }

  //getting all properties of specific class
  protected function properties()
  {
    $properties = array();
    foreach(self::$db_table_fields as $db_field)
    {
      if(property_exists($this, $db_field))
      {
        $properties[$db_field] = $this->$db_field;
      }
    }

    return $properties;
  }

  protected function clean_properties()
  {
    global $database;

    $clear_properties = array();
    foreach($this->properties() as $key => $value)
    {
      $clear_properties[$key] = $database->escape_string($value);
    }

    return $clear_properties;
  }

  //Method for determinate if we are using update or create method
  public function save()
  {
    return isset($this->id) ? $this->update() : $this->create();
  }

  //Method for creating new user
  public function create()
  {
    global $database;
    $properties = $this->clean_properties();
    $sql = "INSERT INTO ".self::$db_table."(".implode(",", array_keys($properties)).")";
    $sql .= "VALUES ('".implode("','", array_values($properties))."')";

    if($database->query($sql))
    {
      $this->id = $database->the_insert_id();

      return true;
    }
    else
    {
      return false;
    }
  }

  //Method for updating spectific user
  public function update()
  {
    global $database;

    $properties = $this->clean_properties();
    $properties_pairs = array();
    foreach($properties as $key => $value)
    {
      $properties_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE ".self::$db_table." SET ";
    $sql .= implode(",", $properties_pairs);
    $sql .= " WHERE id = ".$database->escape_string($this->id);

    $database->query($sql);

    return (mysqli_affected_rows($database->connection) == 1) ? true : false;
  }

  //Method for deleting specific user
  public function delete()
  {
    global $database;

    $sql = "DELETE FROM ".self::$db_table." ";
    $sql .= "WHERE id = ".$database->escape_string($this->id)." ";
    $sql .= "LIMIT 1";
    $database->query($sql);

    return (mysqli_affected_rows($database->connection) == 1) ? true : false;
  }
} //End of user class
?>
