<?php require_once './database/connection.php'; ?>

<?php

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./index.php');
}

$sql = "SELECT * FROM `users` WHERE `id` = ${id}";
$result = $conn->query($sql);

$user = $result->fetch_assoc();

$name = $user['name'];
$email = $user['email'];
$error = $success = '';

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name)) {
        $error = 'Provide your name!';
    } elseif (empty($email)) {
        $error = 'Provide your email!';
    } else {
        $sql = "UPDATE `users` SET `name` = '${name}', `email` = '${email}' WHERE `id` = ${id}";

        if ($conn->query($sql)) {
            $success = 'User has been successfully updated!';
        } else {
            $error = 'User has failed to update!';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-danger"><?php echo $error; ?></div>
                        <div class="text-success"><?php echo $success; ?></div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $id ?>" method="post">
                            <div class="mb-2">
                                <label for="name">Name</label>
                                <input type="name" class="form-control" id="name" name="name" placeholder="Enter the name" value="<?php echo $name; ?>">
                            </div>
                            <div class="mb-2">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter the email" value="<?php echo $email; ?>">
                            </div>

                            <div class="mb-2">
                                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                            </div>
                            <hr>
                            <div class="d-grid">
                                <a href="./index.php" class="btn btn-dark">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>