<?php
class Paginate
{
  public $current_page;
  public $items_per_page;
  public $items_total_count;

  public function __construct($page = 1, $items_per_page = 4, $items_total_count = 0)
  {
    $this->current_page = (int)$page;
    $this->items_per_page = (int)$items_per_page;
    $this->items_total_count = (int)$items_total_count;
  }

  //Method for going to next page
  public function next()
  {
    return $this->current_page + 1;
  }

  //Method for going to precious page
  public function previous()
  {
    return $this->current_page - 1;
  }

  //Number of pages
  public function page_total()
  {
    //We are rounding a value of total pages number to be an integer
    return ceil($this->items_total_count/$this->items_per_page);
  }

  //Checking if we need to have pravious button
  public function has_previous()
  {
    return $this->previous() >= 1 ? true : false;
  }

  //Checking if we need to have next button
  public function has_next()
  {
    return $this->next() <= $this->page_total() ? true : false;
  }

  //This method is going to be used in sql statements for determinating OFFSET
  public function offset()
  {
    return ($this->current_page - 1) * $this->items_per_page;
  }
}
?>
