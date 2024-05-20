<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fullname'])){

    require 'db_conn.php';

    $userId = $_SESSION['id'];

    $sql = "SELECT profile_pic, description FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    $user = $stmt->fetch();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="shadow w-450 p-4 text-center">
            <img src="uploads/<?=$user['profile_pic']?>"class="object-fit-cover border rounded" alt="Profile Picture" width="150" height="150">
            <h3 class="display-5">Halo! <?=$_SESSION['fullname']?></h3>
            <p class="mt-3"><?=$user['description']?></p> <!-- Menampilkan deskripsi singkat -->
            <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
            <a href="logout.php" class="btn btn-danger">
                LogOut
            </a>
        </div>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit;
} 
?>
