<?php
include "partials/header.php";
include "partials/navigation.php";
require_once 'controllers/StudentController.php';

if(!is_user_logged_in()){
    redirect("index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    
    $studentController = new StudentController();
    $result = $studentController->deleteStudent($student_id);
    
    if($result) {
        $_SESSION['message'] = "Student deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete student";
    }
    
    redirect("dashboard.php");
} else {
    $_SESSION['error'] = "Invalid request";
    redirect("dashboard.php");
}
?>
