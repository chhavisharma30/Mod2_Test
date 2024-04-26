<?php

//Require the predefined constants for database.
require 'config.php';

//Class to delete item
class DelItem {
  /**
   * @var $db_conn
   *  Variable for database connection.
   */
  public $db_conn;

  /**
   * @return null
   * 
   * Function for database connection.
   */
  public function connect() {
    $this->db_conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
    if ($this->db_conn->connect_error) {
      echo '<script>alert("Connection not established!!")</script>';
      die("ERROR: Could not connect. " . $this->db_conn->connect_error);
    }
  }

  /**
   * @return null
   * 
   * Function to delete an item.
   */
  public function delete() {
    $id = $_GET['id'];
    $record = mysqli_query($this->db_conn, "DELETE FROM items_table WHERE ItemId = $id");
    echo '<script>alert("Deleted Successfully!")</script>';
    echo "<script>window.location.href='/home.php';</script>";
  }

}

//Instance of DelItem class for executing functions.
$delItem = new DelItem();
$delItem->connect();
$delItem->delete();

