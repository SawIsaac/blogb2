<?php
    
    include "../dbconnect.php";
    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();

    $id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE categories.id= :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
         $name = $_POST['name'];
        
        //  $sql = "INSERT INTO categories (name) VALUES(:name)";
        $sql = "UPDATE categories SET name=:name WHERE id=:id";
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(':id',$id);
         $stmt->bindParam(':name',$name);
         $stmt->execute();

        header("Location: categories.php");
        exit();        
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
            <h1 class="d-inline-block">Edit Category</h1>
            <button class="btn btn-danger float-end">Cancel</button>
        </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>">
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