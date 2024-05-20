<?php
session_start();

if(isset($_POST['usname']) && 
   isset($_POST['pw'])){
    
    include ("../db_conn.php");

    $usname = $_POST['usname'];
    $pw = $_POST['pw'];

    $data = "usname=".$usname;

    if (empty($usname)){
        $em = "Username Harus Diisi!";
        header("Location: ../login.php?error=$em&$data");
    exit;
    }else if (empty($pw)){
        $em = "Password Harus Diisi!";
        header("Location: ../login.php?error=$em&$data");
    exit;
    }else {
  
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usname]);

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            $username = $user['username'];
            $password = $user['password'];
            $fullname = $user['fullname'];
            $id = $user['id'];
            if($username === $usname){
                if(password_verify($pw, $password)){
                    $_SESSION['id'] = $id;
                    $_SESSION['fullname'] = $fullname;

                    header("Location: ../home.php");
                    exit;
                }else{
                    $em = "Username atau Password Tidak Benar!";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                }

            }else{
            $em = "Username atau Password Tidak Benar!";
            header("Location: ../login.php?error=$em&$data");
            exit;
           }

        }else{
            $em = "Username atau Password Tidak Benar!";
            header("Location: ../login.php?error=$em&$data");
            exit;
    }
}

}else {
    header("Location: ../login.php?error=error");
    exit;
}


?>