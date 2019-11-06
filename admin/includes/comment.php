<?php
class Comment extends Db_object
{
  protected static $db_table = 'comments';
  protected static $db_table_fields = array('photo_id', 'author', 'body', 'date');
  public $id;
  public $photo_id;
  public $author;
  public $body;
  public $date;

  public static function create_comment($photo_id, $author = "John Doe", $body = "")
  {
    if(!empty($photo_id) && !empty($author) && !empty($body))
    {
      $comment = new Comment();
      //value of photo_id needs to be integer because of int in brackets
      $comment->photo_id = (int)$photo_id;
      $comment->author = $author;
      $comment->body = $body;
      $comment->date = date('Y-m-d H:i:s');

      return $comment;
    }
    else
    {
      return false;
    }
  }

  public static function find_the_comments($photo_id = 0)
  {
    global $database;

    $sql = "SELECT * FROM ".self::$db_table." ";
    $sql .= "WHERE photo_id = ".$database->escape_string($photo_id)." ";
    $sql .= "ORDER BY photo_id ASC";

    return self::find_by_query($sql);
  }
} //End of user class
?>
