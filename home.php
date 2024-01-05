<?php
include 'actions/config.php';
include 'actions/qrcode.php';
session_start();

if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $userRole = $_SESSION['user_role'];

    $sql = "SELECT * FROM users WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $name = $userData['first_name'] . ' ' . $userData['last_name'];
        $image = 'images/users/'.$userData['image'];

        $userList = [];

        if ($userRole == 'admin') {
            $allUsersSql = "SELECT * FROM users WHERE role != 'admin'";
            $allUsersResult = $conn->query($allUsersSql);

            if ($allUsersResult->num_rows > 0) {
                while ($userRow = $allUsersResult->fetch_assoc()) {
                    $userList[] = $userRow;
                }
            }
        } elseif ($userRole == 'manager') {
            $managerUsersSql = "SELECT * FROM users WHERE role = 'user'";
            $managerUsersResult = $conn->query($managerUsersSql);

            if ($managerUsersResult->num_rows > 0) {
                while ($userRow = $managerUsersResult->fetch_assoc()) {
                    $userList[] = $userRow;
                }
            }
        }
    }

    $conn->close();
} else {
    header("Location: index.php");
    exit();
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
        <div class="row">
            <div class="col-md-3">
                <div class="card rounded p-4">
                    <h3>Hello <?php echo $name ;?></h3>
                    <img class="rounded" src="<?php echo $image ?>" alt="">
                    <?php generateQRCode($userEmail); ?>
                    <a href="actions/logout.php" class="btn btn-danger my-3">Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <?php if (!empty($userList)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <?php if ($userRole == 'admin'): ?>
                                    <th>Role</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userList as $user): ?>
                                <tr>
                                    <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <?php if ($userRole == 'admin'): ?>
                                        <td><?php echo $user['role']; ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
