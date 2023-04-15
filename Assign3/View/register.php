<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Register</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required autocomplete="off">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </form>
    </div>
    <?php
include_once '../Config/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $conn = connect_sql();
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if username or email already exists in the database
    $query = "SELECT * FROM voters WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result->num_rows > 0) {
        // Duplicate username or email found
        echo "Username or email already exists in the database.";
    } else {
        if ($password === $confirm_password) {
            // Passwords match, proceed with registration
            $query = "INSERT INTO voters (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssss", $first_name, $last_name,$username, $email,$password);

            if ($stmt->execute()) {
                // Registration success
                echo "Registration successful.";
                $stmt->close();
                $conn->close();
                header("Location: ./poll.php");
                // Redirect or take other actions as needed
            } else {
                // Registration failed
                echo "Registration failed.";
                $stmt->close();
                $conn->close();
                // Handle error or redirect as needed
            }
        } else {
            // Passwords do not match
            echo "Passwords do not match.";
        }
    }
}
?>
</body>
</html>
