<?php
//Require the predefined constants for database
require 'config.php';

//Class to Add item in list
class Item {
  /**
   * @var $db_conn
   *  Variable for database connection
   */
  public $db_conn;
  /**
   * @var $title
   *  Variable for item title
   */
  public $title;

  /**
   * @var $description
   *  Variable for item description
   */
  public $description;

  /**
   * @var $creationTime
   *  Variable for database connection
   */
  public $creationTime;

  /**
   * @return null
   * 
   * Function for database connection
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
   * Function to get item details
   */
  public function getData() {
    $this->title = $_POST["title"];
    $this->description = $_POST["details"];
  }

  /**
   * @return null
   * 
   * Function to add item in todolist
   */
  public function addItem() {
    $this->creationTime = date("Y-m-d H:i:s");
    $stmt = $this->db_conn->prepare("INSERT INTO items_table (Title, Description, CreationTime) VALUES (?,?,?)");

    $stmt->bind_param("sss", $this->title, $this->description, $this->creationTime);

    try {
      $stmt->execute();
      echo '<script>alert("Item Added Successfully!!")</script>';
      echo "<script>window.location.href='home.php';</script>";

    } catch (\Exception $e) {
      echo '<script>alert("Error!! Failed to create new post.")</script>';
      $e->getMessage();
    }
  }
}

//If request method is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Create new instance of Item class to add item
  $item = new Item();
  $item->connect();
  $item->getData();
  $item->addItem();
}
