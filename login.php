<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intital-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="shadow w-450 p-4"
            action="php/login.php"
            method="post">

            <h4>LogIn</h4><br>
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text"
                   class="form-control"
                   name="usname"
                   value="<?php echo (isset($_GET['usname']))?$_GET['usname']:
                        ""; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   class="form-control"
                   name="pw">
        </div>
    
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="index.php" class="link-secondary">Sign Up</a>
        </form>
    </div>
</body>
</html>