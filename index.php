<?php
require_once "controllers/UserController.php";
include "partials/header.php";
include "partials/navigation.php";

if(is_user_logged_in()){
  redirect("dashboard.php");
}

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["email"];
    $password = $_POST["password"];
    
    $userController = new UserController();
    $error = $userController->login($username, $password);
    
    if(empty($error)) {
        redirect("dashboard.php");
    }
}
?>

    <div class="container">
        <h2>Login</h2>
        <p style = "color:red"> <?php echo $error; ?> </p>
        <div class="form-container">    
            <form method="POST">
                <div>
                    <label for="email">email:</label>
                    <input id="email" placeholder="Enter your email" type="text" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input id="password" placeholder="Enter your password" type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

<?php include "partials/footer.php"; ?>
<?php
    mysqli_close($conn);
?>
