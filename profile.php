<?php
require('./connection.php');
require('./functions.php');
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $select = "select name, email, enrollment, DOB, phone, city from registration r, users u where  r.id = u.id and r.email = '" . $email . "'";
    $res = mysqli_query($con, $select);
    if (mysqli_error($con)) {
        echo "<scrpit>alert('Something went wrong');</script>";
        unset($_SESSION);
        header('location:login.php');
    } else {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $email = $row['email'];
        $enr = $row['enrollment'];
        $dob = $row['DOB'];
        $pn = $row['phone'];
        $city = $row['city'];
    }
} else {
    header('location:index.php');
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
    <div class='container d-flex flex-column justify-content-center align-items-center min-vh-100'>
        <h1>Profile Details</h1>
        <table class="table">
            <tbody>
                <tr>
                    <td scope="row">Name</td>
                    <td>Email</td>
                    <td>Enrollment No.</td>
                    <td>DOB</td>
                    <td>Phone</td>
                    <td>City</td>
                </tr>
                <tr>
                    <td scope="row"><?php echo $name ?></td>
                    <td scope="row"><?php echo $email ?></td>
                    <td scope="row"><?php echo $enr ?></td>
                    <td scope="row"><?php echo $dob ?></td>
                    <td scope="row"><?php echo $pn ?></td>
                    <td scope="row"><?php echo $city ?></td>
                </tr>
            </tbody>
        </table>
        <a class='btn btn-danger' href="./logout.php">Logout</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>