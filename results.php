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
    $searchtype = '';
    $searchterm = '';

    // TODO 2: Check and filter data coming from the user.
    if (isset($_POST['searchtype']) && isset($_POST['searchterm'])) {
        $searchtype = $_POST['searchtype'];
        $searchterm = $_POST['searchterm'];

        echo "Search with $searchtype, keywork :- $searchterm";
        
        // TODO 3: Setup a connection to the appropriate database.
        $conn = new mysqli('localhost', 'root', '', 'publications');
        if($conn->connect_error) die("FATAL ERROR");
        
        // TODO 4: Query the database.
        $query = "SELECT * FROM catalogs WHERE $searchtype LIKE '%$searchterm%'";
        $result = $conn->query($query);
        if(!$result) die("Fatal Error");
        
        // TODO 5: Retrieve the results.
        $num_row = $result->num_rows;

        if($num_row > 0) {
            for($i = 0; $i < $num_row; $i++) {
                $row = $result->fetch_assoc();
                $isbn = $row['isbn'];
                $author = $row['author'];
                $title = $row['title'];
                $price = $row['price'];

                echo <<<_END
                <hr>
                <pre>
                ISBN    $isbn
                Author  $author
                Title   $title
                Price   RM $price
                </pre>
                _END;
            }
        }
    }
    // TODO 6: Display the results back to user.


    // TODO 7: Disconnecting from the database.
    $conn->close();

    ?>
</body>
</html>