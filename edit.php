<?php
include_once('connect.php');

$id = $_GET['id'];

$pdoStatement = $pdo->prepare("
    SELECT * FROM `users` WHERE id=$id
");

if (!$pdoStatement->execute()) {
    echo 'xatolik bor';
}

$data = $pdoStatement->fetch();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


    $pdoPostStatement = $pdo->prepare("
        UPDATE `users` SET `name`=:name, `email`=:email, `phone`=:phone, `address`=:address WHERE id=$id
    ");

    $pdoPostStatement->bindParam('name', $name);
    $pdoPostStatement->bindParam('email', $email);
    $pdoPostStatement->bindParam('phone', $phone);
    $pdoPostStatement->bindParam('address', $address);

    if ($pdoPostStatement->execute()) {
        header('location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Table</title>
</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Edit User</h1>
            </div>
            <div class="col-12 text-end mb-3">
                <a class="btn btn-success btn-sm" href="index.php">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-12">
                <form action="" method="post" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" value="<?= $data['name']; ?>" type="text" id="name" name="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" value="<?= $data['email']; ?>" type="text" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone">Phone</label>
                        <input class="form-control" value="<?= $data['phone']; ?>" type="text" id="phone" name="phone" placeholder="Enter phone number">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="address">Address</label>
                        <input class="form-control" value="<?= $data['address']; ?>" type="text" id="address" name="address" placeholder="Enter address">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>