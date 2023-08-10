<?php
    global $conn;

    // Fetch Staff details
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($errors)) {    
            $checkUser = mysqli_query($conn, "SELECT * FROM staffs WHERE id = '$id'");
    
            if (mysqli_num_rows($checkUser) > 0) {    
                // Update record in the staffs table
                $deleteQuery = "DELETE FROM staffs WHERE id = $id";
    
                if ($conn->query($deleteQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Staff record deleted successfully!";
                    session_write_close();
                    header("Location: /staffs/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error deleting record: " . $conn->error . "
                        </div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                    Staff does not exist
                </div>";  
            }
        }


    }
?>