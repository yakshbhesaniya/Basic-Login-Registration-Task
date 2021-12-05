<?php
require('./connection.php');
require('./functions.php');
session_start();

if (isset($_POST['submit'])) {
    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);
    $dob = get_safe_value($con, $_POST['dob']);
    $confirm = get_safe_value($con, $_POST['confirm']);
    $name = get_safe_value($con, $_POST['name']);
    $pn = get_safe_value($con, $_POST['pn']);
    $enr = get_safe_value($con, $_POST['enr']);
    $city = get_safe_value($con, $_POST['city']);

    if (strlen($password) < 8) {
        echo "<script>alert('Password length must be > 8')</script>";
    } else if ($password != $confirm) {
        echo "<script>alert('Password and confirm password does not match')</script>";
    } else {

        $select = "SELECT * FROM REGISTRATION WHERE email = '" . $email .  "'";
        $res = mysqli_query($con, $select);
        if (mysqli_error($con)) {
            exit("failed to load page " . mysqli_error($con));
        } else {
            if (mysqli_num_rows($res) != 0) {
                echo "<script>alert('user already exist')</script>";
                header('Location:login.php');
            } else {
                $insert = "insert into REGISTRATION(email, password) values('" . $email . "', '" . $password . "')";
                $res = mysqli_query($con, $insert);
                if (mysqli_error($con)) {
                    echo "<script>alert('Something went wrong')</script>";
                } else {
                    $id = mysqli_insert_id($con);
                    $insert = "insert into users(id, name, enrollment, dob, phone, city) values('" . $id . "', '" . $name . "', '" . $enr . "', '" . $dob . "',  '" . $pn . "',  '" . $city . "')";
                    $res = mysqli_query($con, $insert);
                    if (mysqli_error($con)) {
                        echo "<script>alert('Something went wrong')</script>";
                    } else {
                        $_SESSION['email'] = $email;
                        header("location:profile.php");
                    }
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaksh Bhesaniya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./Login.php">Login</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page" href="./Register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class='container d-flex flex-column justify-content-center align-items-center min-vh-100 form'>
        <h1 class='m-5'>Register Yourself</h1>
        <form class='w-50' method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name='name' aria-describedby="nameHelp">
            </div>
            <div class="mb-3">
                <label for="enr" class="form-label">Enrollment No.</label>
                <input name='enr' type="text" class="form-control" id="enr">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of birth</label>
                <input name='dob' type="date" class="form-control" id="dob">
            </div>
            <div class="mb-3">
                <label for="pn" class="form-label">Phone Number</label>
                <input name='pn' type="text" class="form-control" id="pn">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input name='city' type="text" class="form-control" id="city">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email'>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name='password'>
            </div>
            <div class="mb-3">
                <label for="confirmpwd" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name='confirm' id="confirmpwd">
            </div>

            <button type="submit" name='submit' class="my-5 btn btn-primary">Register</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>