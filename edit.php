<?php

//Require the predefined constants for database
require 'config.php';

//Class to edit item
class EditItem {
  /**
   * @var $db_conn
   *  Variable for database connection
   */
  public $db_conn;

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
   * Function to edit an item
   */
  public function edit() {

    $id = $_GET['id'];
    $record = mysqli_query($this->db_conn, "SELECT * FROM items_table WHERE ItemId = $id");

    if ($record) {
      $curr_item = mysqli_fetch_array($record);
      ?>

      <head>
        <!-- <link rel="stylesheet" type="text/css" href="http://social.com/assets/edit.css"> -->
        <title>To do list</title>
      </head>
      <h1>Edit Item</h1>
      <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $curr_item['id']; ?>">
        <label for="title">Title:</label><br>
        <input type="text" name="title" value="<?php echo $curr_item['Title']; ?>"><br>
        <label for="description">Description:</label><br>
        <input type="text" name="description" value="<?php echo $curr_item['Description']; ?>"><br>
        <input type="submit" value="Update">
      </form>

      <?php
    }
  }

  /**
   * @return null
   * 
   * Function to update the edited item
   */

  public function update() {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "UPDATE items_table SET Description ='$description', Title = '$title' WHERE ItemId = $id";
    mysqli_query($this->db_conn, $query);
    echo '<script>alert("Updated Successfully!")</script>';
    echo "<script>window.location.href='/home.php';</script>";

  }
}

//Creating instance of EditItem class to edit the item
$item = new EditItem();
$item->connect();

if($_SERVER["REQUEST_METHOD"]=="GET") {
$item->edit();
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $item->update();
}


