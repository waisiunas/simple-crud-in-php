<?php require_once './database/connection.php'; ?>
<?php
$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

// $users = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($row);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="./create_user.php" class="btn btn-outline-primary">Add User</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No. </th>
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Created At </th>
                                    <th>Action </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // foreach ($users as $user) { 
                                ?>
                                <!-- <tr>
                                        <td>1</td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo date('D d-M-Y h:i a', strtotime($user["created_at"])); ?></td>
                                    </tr> -->
                                <?php
                                // }
                                ?>

                                <?php
                                while ($user = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo date('D d-M-Y h:i a', strtotime($user["created_at"])); ?></td>
                                        <td>
                                            <a href="./edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                                            <a href="./delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>