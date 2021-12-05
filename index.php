<?php
if (isset($_SESSION['email'])) {
    header("location:profile.php");
}
header("location:login.php");
