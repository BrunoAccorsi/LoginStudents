<?php 

function is_user_logged_in(){
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function redirect($location){
    header("Location: $location");
    exit;
}

function setActiveCLass($pageName){
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $pageName) ? "active": '';
}

?>