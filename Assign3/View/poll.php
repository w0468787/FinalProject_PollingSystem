<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Poll</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Poll</h1>
        <form method="post" action="poll.php">
            <div class="form-group">
                <label for="option1">Option 1</label>
                <input type="radio" id="option1" name="poll_option" value="option1" required>
            </div>
            <div class="form-group">
                <label for="option2">Option 2</label>
                <input type="radio" id="option2" name="poll_option" value="option2" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
    //this part i dont believe is functional as im not entirely sure how to do the database logic of this. but i tried.
    include_once('../Config/config.php');

    // Create a connection to the database
    $conn = connect_sql();

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    // Get the poll_option value from the form submission
    $pollOption = $_POST['poll_option'];

    // Prepare the SQL statement with a parameter placeholder for poll_option
    $sql = "UPDATE results SET vote_count = vote_count + 1 WHERE option_selected = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the poll_option value to the parameter placeholder
    mysqli_stmt_bind_param($stmt, "s", $pollOption);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Vote count updated successfully";
    } else {
        echo "Error updating vote count: " . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>

</html>