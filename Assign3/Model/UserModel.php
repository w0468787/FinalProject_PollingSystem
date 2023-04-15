<?php
// UserModel.php - handles user data retrieval
error_reporting(E_ALL);
ini_set('display_errors', 1);
  include_once("../Config/config.php");

class UserModel
{
  private $conn;
  public function getLogin()
  {
    // get user data from the database based on username and password
    $conn = connect_sql();
    testConnectSQL();

    if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
      $sql = sprintf(
        "SELECT * FROM voters WHERE username = '%s'",
        $conn->real_escape_string($_POST["username"])
      );
      $result = $conn->query($sql);

      $rows = $result->num_rows;
      if ($rows > 0) {
        $conn->close();
        return 'Login Success';
      } else {
        $conn->close();
        return 'Login Failed';
      }
    }
    //return 'login';
  }
  // Function to register a new user
  public function registerUser($first_name, $last_name, $username, $email, $password)
  {
    $conn = connect_sql();

     $query = "INSERT INTO voters (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
     $stmt = $conn->prepare($query);
     $stmt->bind_param("sssss", $first_name, $last_name,$username, $email,$password);

     if ($stmt->execute()) {
         // Registration success
         echo 'success';
         $stmt->close();
         $conn->close();
         return true;
     } else {
         // Registration failed
         $stmt->close();
         $conn->close();
         return false;
     }
    }
}
?>