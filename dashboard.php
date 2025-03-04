<?php
include "partials/header.php";
include "partials/navigation.php";
require_once 'controllers/StudentController.php';

if(!is_user_logged_in()){
    redirect("login.php");
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

<div class="container" style="align-items: flex-start; padding: 20px;">
    <h1>Student Management Dashboard</h1>
    
    <?php if($message): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <?php if($error): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <h2>Students List</h2>
        <a href="add_student.php" style="background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
            Add New Student
        </a>
    </div>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Student ID</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Name</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Email</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(mysqli_num_rows($students) > 0): ?>
                <?php while($student = mysqli_fetch_assoc($students)): ?>
                    <tr>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;"><?php echo $student['student_id']; ?></td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;"><?php echo $student['name']; ?></td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;"><?php echo $student['email']; ?></td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                            <form method="POST" action="delete_student.php" style="display: inline;">
                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" 
                                    style="background-color: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="padding: 12px; text-align: center;">No students found. Add your first student!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "partials/footer.php"; ?>