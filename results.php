<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    // TODO 1: Create short variable names.
    $searchtype=$_POST['searchtype'];
    $searchterm=trim($_POST['searchterm']);

    // TODO 2: Check and filter data coming from the user.
    if (!$searchtype || !$searchterm) {
        echo "You have not entered search details.  Please go back and try again.";
        exit;
     }   

     if (!get_magic_quotes_gpc()) {
        $searchtype = addslashes($searchtype);
        $searchterm = addslashes($searchterm);
      }

    // TODO 3: Setup a connection to the appropriate database.
      $conn = new mysqli('localhost', 'root', '', 'bookentry');

      if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }
  

    // TODO 4: Query the database.
      $query = "select * from catalogs where ".$searchtype." like '%".$searchterm."%'";
      
    // TODO 5: Retrieve the results.
      $result = $conn->query($query);
  
      $num_results = $result->num_rows;

    // TODO 6: Display the results back to user.
      echo "<p>Number of books found: ".$num_results."</p>";

    for ($i=0; $i <$num_results; $i++) {
      $row = $result->fetch_assoc();
      echo "<p><strong>".($i+1).". Title: ";
      echo htmlspecialchars(stripslashes($row['title']));
      echo "</strong><br />Author: ";
      echo stripslashes($row['author']);
      echo "<br />ISBN: ";
      echo stripslashes($row['isbn']);
      echo "<br />Price: ";
      echo stripslashes($row['price']);
      echo "</p>";
     }

    // TODO 7: Disconnecting from the database.
      $conn->close();

    ?>
</body>
</html>