<?php 
    include_once "../common/header.php";
    include_once "../config/db_connect.php";
    include_once "../common/validation.php";
    ?>
    <div class="container my-5">
        
        <div class="d-flex align-items-center mb-5">
            <a href="/staffs/" class="text-decoration-none">
                <h3 class="text-muted">Staffs</h3>
            </a> 
            <h4 class="text-danger">
                &nbsp;
                /
                Delete Staff
            </h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="card card-body bg-light text-center">
                    <p class="text-muted">Are you sure you want to delete this staff?</p>
                    <form class="inline-block" method="POST">
                        <?php include "../backend/staffs/delete.php" ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="/staffs/index.php" class="d-inline-block btn btn-white border">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once "../common/footer.php" ?>
