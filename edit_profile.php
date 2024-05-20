<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fullname'])) {
    require 'db_conn.php';
    $userId = $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $description = $_POST['description'];
        $birth_date = $_POST['birth_date'];
        $birth_place = $_POST['birth_place'];

        // Mengelola unggahan foto profil
        if (!empty($_FILES['profile_pic']['name'])) {
            $profilePicName = time() . '_' . $_FILES['profile_pic']['name'];
            $target = 'uploads/' . $profilePicName;

            // Pindahkan file yang diunggah ke direktori target
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target)) {
                // Update database dengan file yang diunggah
                $sql = "UPDATE users SET username=?, fullname=?, description=?, birth_date=?, birth_place=?, profile_pic=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username, $fullname, $description, $birth_date, $birth_place, $profilePicName, $userId]);
            } else {
                echo "Failed to upload file.";
            }
        } else {
            $sql = "UPDATE users SET username=?, fullname=?, description=?, birth_date=?, birth_place=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $fullname, $description, $birth_date, $birth_place, $userId]);
        }

        $_SESSION['fullname'] = $fullname;
        header("Location: home.php");
        exit;
    } else {
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Profile</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="<?=$user['username']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullname" value="<?=$user['fullname']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"><?=$user['description']?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Birth Date</label>
                <input type="date" class="form-control" name="birth_date" value="<?=$user['birth_date']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Birth Place</label>
                <input type="text" class="form-control" name="birth_place" value="<?=$user['birth_place']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_pic">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit;
}
?>
