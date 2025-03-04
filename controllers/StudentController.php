<?php
require_once 'models/Student.php';
require_once 'config/Database.php';

class StudentController
{
  private $studentModel;

  public function __construct() {
    $database = new Database();
    $db = $database->connect();
    $this->studentModel = new StudentModel($db);
  }

  public function getAllStudents(){
    return $this->studentModel->read();
  }

  public function addStudent($name, $email, $student_id){
    $this->studentModel->name = $name;
    $this->studentModel->email = $email;
    $this->studentModel->student_id = $student_id;
    
    return $this->studentModel->create();
  }

  public function deleteStudent($id){
    $this->studentModel->id = $id;
    return $this->studentModel->delete();
  }
}