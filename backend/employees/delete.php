<?php
    global $conn;
    $first_name = $last_name = $gender = $email = $phone = $job_title = $salary = ""; 


    // Fetch employee details
    $id = $_GET['id'];
    $query = "SELECT * FROM employees WHERE id=$id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($errors)) {    
            $checkUser = mysqli_query($conn, "SELECT * FROM employees WHERE id = '$id'");
    
            if (mysqli_num_rows($checkUser) > 0) {    
                // Update record in the employees table
                $deleteQuery = "DELETE FROM employees WHERE id = $id";
    
                if ($conn->query($deleteQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Employee record deleted successfully!";
                    session_write_close();
                    header("Location: /employees/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error deleting record: " . $conn->error . "
                        </div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                    Employee does not exist
                </div>";  
            }
        }


    }
?>