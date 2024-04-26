<?php

//Loading predefined constants
require 'config.php';

//Database class for database connection
class Database {
  
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
    $this->db_conn = new \mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME); 
    if ($this->db_conn->connect_error) {
      echo '<script>alert("Connection not established!!")</script>';
      die("ERROR: Could not connect. " . $this->db_conn->connect_error);
    }
  }

}