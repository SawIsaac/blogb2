<?php
    include "../dbconnect.php";
    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile_arr = $_FILES['profile'];

        // echo "$user and $email and $password";
        // print_r($profile_arr);

        if(isset($profile_arr) && $profile_arr['size'] > 0){
            $dir = 'images/';
            $profile = $dir.$profile_arr['name'];

            $tmp_name = $profile_arr['tmp_name'];
            move_uploaded_file($tmp_name,$profile);
        };

        $sql = "INSERT INTO users (name,email,password,profile) VALUES(:name,:email,:password,:profile)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name',$user);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        $stmt->bindParam(':profile',$profile);
        $stmt->execute();       

        header("location: users.php");
        exit;
    }else{
        include "layouts/nav_sidebar.php";
    }

   
?>
    
<style>
    .post-form{
        width: 100%;
        padding: 25px;
        border: 1px solid rgba(0,0,0,0.1);
        margin: 0 auto;
    }
</style>

<div class="container">
    <div class="post-form">
        <div>
            <h1 class="d-inline-block">Create User</h1>
            <button class="btn btn-danger float-end">Cancel</button>
        </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">email</label>
                    <input  type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile" name="profile">
                </div>
                <button class="btn btn-primary w-100 mt-3 text-center" type="submit">
                    Submit
                </button>
            </form>
    </div>
    
</div>

<?php
    include "layouts/footer.php";
?>