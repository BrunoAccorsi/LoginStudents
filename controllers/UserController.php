<?php
require_once 'models/User.php';
require_once 'config/Database.php';

class UserController {
    private $userModel;
    
    public function __construct() {
      $database = new Database();
      $db = $database->connect();
      $this->userModel = new User($db);
    }
    
    public function register($username, $email, $password, $confirm_password) {
        $error = "";
        
        // Check if the password and confirm match
        if($password !== $confirm_password){
            return "Passwords do not match";
        }
        
        // check if email already exists
        if($this->userModel->exists($email)){
            return "Email already exists, Please choose another";
        }
        
        // Create user
        if($this->userModel->create($username, $email, $password)){
            // Set session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            return "";
        } else {
            return "Something went wrong, user not created";
        }
    }
    
    public function login($email, $password) {
        $user = $this->userModel->getByEmail($email);
        
        if(!$user) {
            return "User not found";
        }
        
        if(password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            return "";
        } else {
            return "Invalid password";
        }
    }
    
    public function logout() {
        $_SESSION = [];
        session_destroy();
        setcookie('PHPSESSID', '', time() - 3600, '/');
    }
}
