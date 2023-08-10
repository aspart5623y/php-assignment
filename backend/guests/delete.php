<?php
    global $conn;

    // Fetch guest details
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($errors)) {    
            $checkUser = mysqli_query($conn, "SELECT * FROM guests WHERE id = '$id'");
    
            if (mysqli_num_rows($checkUser) > 0) {    
                // Update record in the guests table
                $deleteQuery = "DELETE FROM guests WHERE id = $id";
    
                if ($conn->query($deleteQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Guest record deleted successfully!";
                    session_write_close();
                    header("Location: /guests/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error deleting record: " . $conn->error . "
                        </div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                    Guest does not exist
                </div>";  
            }
        }


    }
?>