<?php
include "partials/header.php";
include "partials/navigation.php";
require_once 'controllers/StudentController.php';

if(!is_user_logged_in()){
    redirect("login.php");
}

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];
    
    if(empty($name) || empty($email) || empty($student_id)) {
        $error = "All fields are required";
    } else {
        $studentController = new StudentController();
        $result = $studentController->addStudent($name, $email, $student_id);
        
        if($result) {
            $_SESSION['message'] = "Student added successfully!";
            redirect("dashboard.php");
        } else {
            $error = "Failed to add student";
        }
    }
}
?>

<div class="container">
    <h2>Add New Student</h2>
    <?php if($error): ?>
        <p style="color: red"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <div>
            <label for="student_id">Student ID:</label>
            <input id="student_id" placeholder="Enter student ID" type="text" name="student_id" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input id="name" placeholder="Enter student name" type="text" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input id="email" placeholder="Enter student email" type="email" name="email" required>
        </div>
        <div style="display: flex; gap: 10px;">
            <button type="submit">Add Student</button>
            <a href="dashboard.php" style="text-decoration: none; padding: 8px; background-color: #ccc; color: black; border-radius: 4px;">Cancel</a>
        </div>
    </form>
</div>

<?php include "partials/footer.php"; ?>
