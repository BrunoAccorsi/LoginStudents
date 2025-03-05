<?php
class User {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function create($username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, email) 
                VALUES ('$username', '$passwordHash', '$email')";
        return mysqli_query($this->conn, $sql);
    }
    
    public function getByEmail($email) {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }
    
    public function exists($email) {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result) > 0;
    }
}
