<?php
    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";
    $sql = "SELECT * FROM posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
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
            <h1 class="d-inline-block">Post create</h1>
            <button class="btn btn-danger float-end">Cancel</button>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Categories</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Select category</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button class="btn btn-primary w-100 mt-3 text-center">
            POST
        </button>
    </div>
    
</div>

<?php
    include "layouts/footer.php";
?>