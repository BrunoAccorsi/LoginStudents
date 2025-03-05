<?php
include "partials/header.php";
include "partials/navigation.php";
require_once 'controllers/StudentController.php';

if(!is_user_logged_in()){
    redirect("index.php");
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<!-- Add the CSS link if not already included -->
<link rel="stylesheet" href="css/table-styles.css">

<div class="container" style="align-items: flex-start; padding: 20px;">
    <h1>Add New Student</h1>
    
    <?php if($error): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <div class="form-container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="number" id="student_id" name="student_id" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="dashboard-header">
                <button type="submit" class="btn btn-success">Add Student</button>
                <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </form>
    </div>
</div>

<?php include "partials/footer.php"; ?>
