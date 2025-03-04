<?php
class Database {
  private $host = 'localhost';
  private $db_name = 'students';
  private $username = 'root';
  private $password = 'root';
  private $conn;

  public function connect() {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

    return $this->conn;
  }
}