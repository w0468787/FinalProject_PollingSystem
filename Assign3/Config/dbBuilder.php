<?php
// Include database configuration
include_once('config.php');

// Create a connection to the database
$conn = connect_sql();

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL statement to create the voters table
// $sql = "CREATE TABLE voters (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     first_name VARCHAR(50) NOT NULL,
//     last_name VARCHAR(50) NOT NULL,
//     username VARCHAR(50) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//     password VARCHAR(255) NOT NULL
// )";

// //  SQL statement
// if (mysqli_query($conn, $sql)) {
//     echo "Table 'voters' created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($conn);
// }

//Create The Polls Table
$sql = "CREATE TABLE polls (
    poll_id INT AUTO_INCREMENT PRIMARY KEY,
    poll_title VARCHAR(255) NOT NULL,
    poll_description TEXT,
    other_metadata VARCHAR(255)
)";

// SQL statement
if (mysqli_query($conn, $sql)) {
    echo "Table 'polls' created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Insert filler data into the polls table
$sql_insert = "INSERT INTO polls (poll_title, poll_description, other_metadata)
               VALUES ('Sample Poll 1', 'This is a sample poll 1 description', 'Sample metadata 1'),
                      ('Sample Poll 2', 'This is a sample poll 2 description', 'Sample metadata 2')";

// Execute the SQL statement 
if (mysqli_query($conn, $sql_insert)) {
    echo "Filler data inserted into 'polls' table successfully<br>";
} else {
    echo "Error inserting filler data: " . mysqli_error($conn);
}


// SQL statement to create the results table
//forgot vote_count row added it in the phpAdmin
$sql = "CREATE TABLE results (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    option_selected VARCHAR(50) NOT NULL,
    voter_id INT NOT NULL,
    FOREIGN KEY (poll_id) REFERENCES polls(poll_id),
    FOREIGN KEY (voter_id) REFERENCES voters(id)
)";

// Execute the SQL statement
if (mysqli_query($conn, $sql)) {
    echo "Table 'results' created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
// SQL statement to insert data into the voters table (testing at first )
// $sql_insert = "INSERT INTO voters (first_name, last_name, username, email, password)
//                VALUES ('Joho', 'Doe', 'drew', 'johndoe@example.com', 'mypassword')";

// // Execute the SQL statement
// if (mysqli_query($conn, $sql_insert)) {
//     echo "Row inserted successfully";
// } else {
//     echo "Error inserting row: " . mysqli_error($conn);
// }

// Close the database connection
mysqli_close($conn);
?>