<?php
    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";
    $sql = "SELECT * FROM posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
?>
    
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
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
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                    foreach($posts as $post){
                                ?>
                            <tr>
                                    <td><?= $post['id'] ?></td>
                                    <td><?= $post['title'] ?></td>
                                    <td><?= $post['category_id'] ?></td>
                                    <td><?= $post['user_id'] ?></td>
                                    <td><button class="btn btn-warning w-25 mx-1">Edit</button><button class="btn btn-danger w-50 mx-1">Delet</button></td>
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

<?php
    include "layouts/footer.php";
?>