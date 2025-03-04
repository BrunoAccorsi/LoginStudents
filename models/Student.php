<?php

class StudentModel {
  private $conn;
  public $id; // This is the database auto-increment ID
  public $name;
  public $email;
  public $student_id; // This is the student's actual ID number assigned by the school/institution

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function read() {
    $query = "SELECT * FROM students ORDER BY id DESC";
    return $this->conn->query($query);
  }

  public function create(){
    // The student_id is a field in the database, not the auto-incrementing primary key
    $query = "INSERT INTO students(name, email, student_id) VALUES('$this->name', '$this->email', '$this->student_id')";
    return $this->conn->query($query);
  }

  public function delete(){
    // Delete uses the auto-incrementing database ID, not the student_id
    $query = "DELETE FROM students WHERE id = " . $this->id;
    return $this->conn->query($query);
  }
}