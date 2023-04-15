<?php
// authController.php - should handle user-related actions

require_once("C:xampp/htdocs/NSCC/Assignments/Assign3/Model/UserModel.php");

class authController {
    public $model;

    public function __construct() {
        $this->model= new UserModel();
        
    }

    public function invoke() {
        // Logic to handle user login and registration
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if all columns are set for registration
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email'])) {
                // Call the registerUser method of the model
                // $username = $_POST['username'];
                // $password = $_POST['password'];
                // $first_name = $_POST['first_name'];
                // $last_name = $_POST['last_name'];
                // $email = $_POST['email'];
                $model=new UserModel();
                $result = $model->userRegister($_POST['username'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['email']);
                
                if($result){
                  echo 'Success';

                }else{
                  echo 'fail';
                }
              
            } else if (isset($_POST['username']) && isset($_POST['password'])) {
                // Redirect to poll.php if only username and password are set
                header('Location: ../View/poll.php');
                exit;
              
              
            } else {
                // Redirect to register.php if all columns are not set
                // Add your logic here
                echo 'help';
              
            }
          
        } else {
            // Redirect to welcome.php if request method is not POST
            header('Location: ../Assign3/View/welcome.php');
            exit;
        }
    }
}
?>
