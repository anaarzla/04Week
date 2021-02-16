<?php
    require 'database.php';
    $newTitle = filter_input(INPUT_POST, "newTitle", FILTER_SANITIZE_STRING);
    $newDescription = filter_input(INPUT_POST, "newDescription", FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html lang = "en">

    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width-device-width, initial-scale=1.0">
        <link rel = "stylesheet" href = "css//main.css">
        <title>ToDo List</title>
    </head>

        <h3>Add things to list</h3>
            <form action = "index.php" method = "POST">
                            <label for="Title"></label><br><input type="text" id="Title" name="title" value="" required><br>
                            <label for="Description"></label><br><input type="text" id="Description" name="description" value="" required>

                            <input id = "addButton" type = "submit" value = "Submit">
            </form>

        <h3>Things to do:</h3>
            <?php
            // Will post the item and desc onto list 
                if (isset($_POST["title"]) && isset($_POST["description"]))
                {
                    $title = $_POST["title"];
                    $description = $_POST["description"];
                    $query = "INSERT INTO todoitems (Title, Description) VALUES ('" . $title . "','" . $description . "')";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $results = $statement->fetchAll();
                    $statement->closeCursor();
                }
                // delete items from the list 
                if (isset($_POST["del"]))
                {
                    $item = $_POST["del"];
                    $query = "DELETE FROM todoitems WHERE ItemNum = '" . $item . "'";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $results = $statement->fetchAll();
                    $statement->closeCursor();
                }

                // retreives info from database 
                $query = "SELECT ItemNum, Title, Description FROM todoitems ORDER BY ItemNum ASC";
                $statement = $db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
                
                $counter = 1;
                foreach ($results as $result) :
                    echo "<form action = 'index.php' method = 'POST'>";
                    echo "<input type = 'number' name = 'del' value = " . $result["ItemNum"] . " style = 'visibility: hidden;'>";
                    echo "<tr><td class = 'content'><b class = 'title'>" . htmlspecialchars($result["Title"]) . "</b><br>";
                    echo htmlspecialchars($result["Description"]) . "</td><td class = 'other'><input type = 'submit' class = 'del' value = 'Delete'></td></tr></form>";
                    $counter++;
                endforeach;

                $query = "ALTER TABLE todoitems AUTO_INCREMENT = $counter";
                $statement = $db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
            ?>
    </body>
</html>