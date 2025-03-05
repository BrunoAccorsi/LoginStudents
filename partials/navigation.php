<nav>
    <ul>
        <?php if(!is_user_logged_in()): ?>
            <li><a href="index.php" class="<?php echo setActiveCLass('index.php'); ?>">Login</a></li>
            <li><a href="register.php" class="<?php echo setActiveCLass('register.php'); ?>">Register</a></li>
        <?php else: ?>
            <li><a href="dashboard.php" class="<?php echo setActiveCLass('dashboard.php'); ?>">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>