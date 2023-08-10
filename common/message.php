<?php 
    if (isset($_SESSION['message'])) {
        if (isset($_SESSION['status']) && $_SESSION['status'] == "success") {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    ". $_SESSION['message'] ."
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } 
        if (isset($_SESSION['status']) && $_SESSION['status'] == "error") {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    ". $_SESSION['message'] ."
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }

        unset($_SESSION['message']);
        unset($_SESSION['status']);
    }
?>