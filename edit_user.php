<?php require_once './database/connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./show_users.php');
}


$sql = "SELECT * FROM `users` WHERE `id` = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$error = $success = '';
$name = $user['name'];
$email = $user['email'];

if (isset ($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name)) {
        $error = 'Please provie your name';
    } elseif (empty($email)) {
        $error = 'Please provie your email';
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `id` != $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE `id` = $id";
            if ($conn->query($sql)) {
                $success = 'User has been succefully updated!';
            } else {
                $error = 'User has failed to update!';
            }
        } else {
            $error = 'E-mail already exist!';
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
    <title>Edit User</title>
    <link rel="stylesheet" href="../bootstrap/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="./show_users.php" class="btn btn-outline-secondary">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $id; ?>" method="post">
                            <div class="text-danger"><?php echo $error; ?></div>
                            <div class="text-success"><?php echo $success; ?></div>

                            <div class="mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name!" value="<?php echo $name; ?>">
                            </div>

                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email!" value="<?php echo $email; ?>">
                            </div>

                            <div>
                                <input type="submit" name="submit" class="btn btn-primary">
                                <input type="reset" class="btn btn-dark">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../bootstrap/js/app.js"></script>

</html>