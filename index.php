<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intital-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="shadow w-450 p-4"
            action="php/signup.php"
            method="post">
            <h4>Create Account</h4><br>
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>

            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-info" role="alert">
                <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>

        <div class="mb-3">
            <label class="form-label">FullName</label>
            <input type="text"
                   class="form-control"
                   name="flname"
                   value="<?php echo (isset($_GET['flname']))?$_GET['flname']:
                        ""; ?>">
        </div>
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
    
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <a href="login.php" class="link-secondary">Login</a>
        </form>
    </div>
</body>
</html>