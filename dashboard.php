<?php
include "partials/header.php";
include "partials/navigation.php";
require_once 'controllers/StudentController.php';

if(!is_user_logged_in()){
    redirect("index.php");
}

$studentController = new StudentController();
$students = $studentController->getAllStudents();

$message = "";
$error = "";

if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!-- Add the CSS link to the head section -->
<link rel="stylesheet" href="css/table-styles.css">

<div class="container" style="align-items: flex-start; padding: 20px;">
    <h1>Student Management Dashboard</h1>
    
    <?php if($message): ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <?php if($error): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <div class="dashboard-header">
        <h2>Students List</h2>
        <a href="add_student.php" class="btn btn-primary table-action-btn">
            Add New Student
        </a>
    </div>
    
    <table class="student-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(mysqli_num_rows($students) > 0): ?>
                <?php while($student = mysqli_fetch_assoc($students)): ?>
                    <tr>
                        <td><?php echo $student['student_id']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <form method="POST" action="delete_student.php" style="display: inline;">
                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" 
                                    class="btn btn-danger table-action-btn">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No students found. Add your first student!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "partials/footer.php"; ?>