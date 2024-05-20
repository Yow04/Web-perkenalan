<?php
if(isset($_POST['flname']) && 
   isset($_POST['usname']) && 
   isset($_POST['pw'])){
    
    include ("../db_conn.php");

    $flname = $_POST['flname'];
    $usname = $_POST['usname'];
    $pw = $_POST['pw'];

    $data = "flname=".$flname."&usname=".$usname;

    if(empty($flname)) {
        $em = "Fullname Harus Diisi!";
        header("Location: ../index.php?error=$em&$data");
    exit;
    }else if (empty($usname)){
        $em = "Username Harus Diisi!";
        header("Location: ../index.php?error=$em&$data");
    exit;
    }else if (empty($pw)){
        $em = "Password Harus Diisi!";
        header("Location: ../index.php?error=$em&$data");
    exit;
    }else {

        // hashing password
        $pw = password_hash($pw, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users(fullname, username, password)
                VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$flname, $usname, $pw]);

        header("Location: ../index.php?success=Akun sudah dibuat!");
    exit;
    }

}else {
    header("Location: ../index.php?error=error");
    exit;
}

?>