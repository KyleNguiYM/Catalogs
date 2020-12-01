<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Entry Results</title>
</head>
<body>
    <h1>Book Entry Results</h1>
    <?php
    // TODO 1: Create short variable names.
        $isbn = $_POST['isbn'];
        $author = $_POST['author'];
        $title = $_POST['title'];
        $price = $_POST['price'];

    // TODO 2: Check and filter data coming from the user.
        if (!$isbn || !$author || !$title || !$price) {
            echo "You have not entered all the required details.<br />"
             ."Please go back and try again.";
        exit;
     }
   
    if(!get_magic_quotes_gpc()) {
       $isbn = addslashes($isbn);
       $author = addslashes($author);
       $title = addslashes($title);
       $price = doubleval($price);
     }

    // TODO 3: Setup a connection to the appropriate database.
        $conn = new mysqli('localhost', 'root', '', 'bookentry');

        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.  Please try again later.";
        exit;
        }

    // TODO 4: Query the database.
        $query = "INSERT into catalogs values
                    ('".$isbn."', '".$author."', '".$title."', '".$price."')";
        $result = $conn->query($query);

    // TODO 5: Display the feedback back to user.
        if ($result) {
            echo  $conn->affected_rows." book inserted into database.";
        } else {
            echo "An error has occurred.  The item was not added.";
        }

    // TODO 6: Disconnecting from the database.
        $conn->close();

    ?>
</body>
</html>