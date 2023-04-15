<?php

// Function to establish MySQLi connection
function connect_sql() {
    // Database credentials
    $host ="localhost";  // replace with your database host
    $username ="root";  // replace with your database username
    $password = "";      // replace with your database password
    $dbname ="pollingsystem"; // replace with your database name

    // Create mysqli object
    $mysqli = new mysqli($host, $username, $password, $dbname);

    // Set error handler
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Check for connection errors
    try {
        if ($mysqli->connect_error) {
            throw new Exception("Connection failed: " . $mysqli->connect_error);
        }
    } catch (Exception $e) {
        trigger_error($e->getMessage(), E_USER_ERROR);
    }

    return $mysqli;
}
function testConnectSQL(){
    $mysqli = connect_sql();

    // Assert that $mysqli is an instance of mysqli
    if ($mysqli instanceof mysqli) {
        echo "Test Passed: connect_sql() returned an instance of mysqli\n";
    } else {
        echo "Test Failed: connect_sql() did not return an instance of mysqli\n";
    }
}
?>