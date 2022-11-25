<?php require_once './database/connection.php'; ?>

<?php

$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

$users = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($result->fetch_all(MYSQLI_ASSOC));
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../bootstrap/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="./create_user.php" class="btn btn-outline-secondary">Add User</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($users) {
                                    foreach ($users as $user) {
                                ?>
                                        <tr>
                                            <td><?php echo $user['name']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['created_at']; ?></td>
                                            <td>
                                                <a href="./edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                                    Delete
                                                </button>
                                                
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>

                                <?php
                                // while ($user = $result->fetch_assoc()) {
                                ?>
                                <!-- <tr>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['created_at']; ?></td>
                                        <td>
                                            <a href="./edit_user.php" class="btn btn-primary">Edit</a>
                                            <a href="./delete_user.php" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr> -->
                                <?php
                                // }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" class="btn btn-danger" id="btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../bootstrap/js/app.js"></script>

<script>
    function deleteUser(id) {
        btnDelete = document.getElementById('btn-delete');
        btnDelete.setAttribute('href', './delete_user.php?id=' + id);
    }
</script>

</html>