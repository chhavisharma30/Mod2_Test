<html>

<head>
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>

</html>

//Ajax functionality for mark as done
<script>
  $(document).ready(function () {
    $(document).on('click', '.action-done', function () {
      var ID = $(this).attr('id');
      $.ajax({
        url: "done.php",
        data: 'id=' + ID,
        type: "POST",
        success: function (data) {
          $("#done" + ID).html(data);
        },
      });
    });
  });
</script>

<?php
//Require the predefined constants for database
require 'config.php';

//Class to Display items on homepage
class Home {
  /**
   * @var $db_conn
   *  Variable for database connection
   */
  public $db_conn;
  /**
   * @var $result
   *  Variable for storing database results
   */
  public $result;
  /**
   * @var $stmt
   *  Variable for storing database queries
   */
  public $stmt;
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
   * Function to display post
   */
  public function displayPost() {
    $this->stmt = "SELECT * FROM items_table ORDER BY CreationTime DESC";
    try {
      $this->result = mysqli_query($this->db_conn, $this->stmt);
    } catch (\Exception $e) {
      $e->getMessage();
    }

    if (mysqli_num_rows($this->result)) {
      echo "<div class = \"container\">";
      foreach ($this->result as $items) {
        echo "<div class = \"item\">";
        $id = $items['ItemId'];
        echo "<h2>" . $items['Title'] . "</h2>";
        echo "<p>" . $items['Description'] . "</p>";
        echo "<a href=\"edit.php?id=$id\">Edit Item</a><br>";
        echo "<a href=\"delete.php?id=$id\">Delete Item</a><br><br><br>";
        ?>
        <div class="right floated" id="done<?php echo $id; ?>">
          <span id="<?php echo $id; ?>" class="action-done">Mark as done</span>
        </div>
        <?php
        echo "</div>";
      }
      echo "<a href=\"index.php\">Add Item</a><br>";
    }
    echo "</div>";
  }
}

//Creating instance of Home class for displaying post on homepage
$home = new Home();
$home->connect();
$home->displayPost();