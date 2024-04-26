<html>

<head>
  <!-- <link rel="stylesheet" type="text/css" href="http://social.com/assets/create.css"> -->
  <title>To do list</title>
</head>

<body>
  <h1>Add todo item</h1>
  
  <!-- Form to add a new item in todo list -->
  <form action="index.php" method="post">
    <label for="title">Title:</label><br>
    <input type="text" name="title" required><br>
    <label for="details">Description:</label><br>
    <input type="text" name="details" required><br>
    <input type="submit" value="Submit">
  </form>
  <a href="home.php">Home</a>
</body>

<?php require "addItem.php"; ?>

</html>