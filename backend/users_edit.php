<?php
  
    include "../dbconnect.php";
    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();

    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE users.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile_arr = $_FILES['new_profile'];
        $old_profile = $_POST['profile'];

        // echo "$user and $email and $password";
        // print_r($profile_arr);

        if(isset($profile_arr) && $profile_arr['size'] > 0){
            $dir = 'images/';
            $profile = $dir.$profile_arr['name'];

            $tmp_name = $profile_arr['tmp_name'];
            move_uploaded_file($tmp_name,$profile);
        }else{
            $profile = $old_profile;
        }

        // $sql = "INSERT INTO users (name,email,password,profile) VALUES(:name,:email,:password,:profile)";
        $sql = "UPDATE users SET name=:name,email=:email,password=:password,profile=:profile WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
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
            <h1 class="d-inline-block">Edit User</h1>
            <button class="btn btn-danger float-end">Cancel</button>
        </div>
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" value=<?= $id ?> name="id">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">email</label>
                    <input  type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                </div>
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $user['password'] ?>">
                </div>
                <div class="mb-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="photo-tab-pane" aria-selected="true">Profile picture</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="new_profile-tab" data-bs-toggle="tab" data-bs-target="#new_profile-tab-pane" type="button" role="tab" aria-controls="new_photo-tab-pane" aria-selected="false">New Profile picture</button>
                          </li>
                        </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <img src="<?= $user['profile'] ?>" alt="" class="img-fluid">
                            <input type="hidden" value=<?= $user['profile']?> name="profile">
                      </div>
                      <div class="tab-pane fade" id="new_profile-tab-pane" role="tabpanel" aria-labelledby="new_profile-tab" tabindex="0">
                            <input class="form-control" type="file" id="profile" name="new_profile">
                      </div>
                    </div>    
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