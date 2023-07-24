<?php
  include "../dbconnect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header("location: users.php");
}  else{
        include "layouts/nav_sidebar.php";
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
?>
    
    <main>
        <div class="container-fluid px-4">
            <div class="mt-3">
                <h1 class="mt-4 d-inline">Users</h1>
                <a class="btn btn-primary float-end" href="users_create.php">Create User</a>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                    <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                    .
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Posts List
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr> 
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Profile</th>
                                <th>EDIT</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                    foreach($users as $user){
                                ?>
                            <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['password'] ?></td>
                                    <td><?= $user['profile'] ?></td>
                                    <td><a href="users_edit.php?id=<?= $user['id'] ?>" class="btn btn-warning  mx-1">Edit</a>
                                    <button type="button" class="btn btn-danger delete" data-id="<?= $user['id'] ?>">
                                        Delet
                                    </button></td>
                            </tr>
                                <?php 
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="deletmodal" tabindex="-1" aria-labelledby="deletmodal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting....</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <h3>Are you sure delet?</h3>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            <form action="" method="post">
                <button type="submit" class="btn btn-danger" id>Delet</button>
                <input type="hidden" name="id" id="del_id">
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
    include "layouts/footer.php";
    }
?>