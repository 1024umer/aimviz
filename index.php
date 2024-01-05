<?php
session_start();

if (isset($_GET['error'])) {
    $errorMessage = urldecode($_GET['error']);
    echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <section class="container py-5 my-5">
        
        <h1 class="my-5 text-center">Welcome to AIMVIZ</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card p-4">
                    <form method="post" action="./actions/register.php" enctype="multipart/form-data">
                        <h4>Register Form</h4>
                        <div class="row">
                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    <input type="text" required placeholder="Enter Your First Name" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    <input type="text" required placeholder="Enter Your Last Name" name="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    <input type="number" required placeholder="Enter Your Phone Number" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    <input type="email" required placeholder="Enter Your Email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    <input type="password" required placeholder="Enter Your Password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Profile Image</label>
                                    <input required type="file" name="image" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p>Please select Category</p>
                            </div>
                            <div class="col-md-2">
                                <p>User</p>
                                <input type="radio" checked name="role" value="user" id="">
                            </div>
                            <div class="col-md-2">
                                <p>Manager</p>
                                <input type="radio" name="role" value="manager" id="">
                            </div>
                        </div>
                        <p>If alreday registered than please just login</p>
                        <div class="my-4">
                            <button class="btn btn-primary w-100" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="card p-4">
                    <form action="./actions/login.php" method="post">
                        <h4>Login Form</h4>
                        <div class="row">
                            <div class="col-md-12 my-4">
                                <div class="form-group">
                                    <input type="email" required placeholder="Enter Your Email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 my-4">
                                <div class="form-group">
                                    <input type="password" required placeholder="Enter Your Password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>