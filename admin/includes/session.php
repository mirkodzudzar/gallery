<?php
class Session
{
  private $signed_in = false;
  public $user_id;
  public $user_username;
  public $message;
  public $count;

  function __construct()
  {
    session_start();
    $this->visitor_count();
    $this->check_the_login();
    $this->check_message();
  }

  //This method is returning a number of refreshes in our application
  public function visitor_count()
  {
    if(isset($_SESSION['count']))
    {
      return $this->count = $_SESSION['count']++;
    }
    else
    {
      return $_SESSION['count'] = 1;
    }
  }

  //Method for showing messages - get/set
  public function message($msg="")
  {
    if(!empty($msg))
    {
      $_SESSION['message'] = $msg;
    }
    else
    {
      return $this->message;
    }
  }

  //Method that checks if there is some message
  private function check_message()
  {
    if(isset($_SESSION['message']))
    {
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    }
    else
    {
      $this->message = "";
    }
  }

  //Getter
  public function is_signed_in()
  {
    return $this->signed_in;
  }

  public function login($user)
  {
    if($user)
    {
      $this->user_id = $_SESSION['user_id'] = $user->id;
      $this->user_username = $_SESSION['user_username'] = $user->username;
      $this->signed_in = true;
    }
  }

  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_username']);
    unset($this->user_id);
    unset($this->user_username);
    $this->signed_in = false;
  }

  private function check_the_login()
  {
    if(isset($_SESSION['user_id']))
    {
      $this->user_id = $_SESSION['user_id'];
      $this->signed_in = true;
    }
    else
    {
      unset($this->user_id);
      $this->signed_in = false;
    }
  }
}

$session = new Session();
$message = $session->message();
?>
