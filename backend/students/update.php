<?php
    global $conn;

    // Fetch employee details
    $id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id=$id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();
    
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $gender = $data['gender'];
    $email = $data['email'];
    $phone = $data['phone'];
    $level = $data['level'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = validateAndSanitize($_POST['first_name'], $errors, 'first_name', "First name is required");
        $last_name = validateAndSanitize($_POST['last_name'], $errors, 'last_name', "Last name is required");
        $gender = validateAndSanitize($_POST['gender'], $errors, 'gender', "Gender is required");
        $email = validateAndSanitize($_POST['email'], $errors, 'email', "Email is required", false, true); // Added true here for email validation
        $phone = validateAndSanitize($_POST['phone'], $errors, 'phone', "Phone is required", true);
        $level = validateAndSanitize($_POST['level'], $errors, 'level', "Level is required");

        if (empty($errors)) {    
            $checkUser = mysqli_query($conn, "SELECT * FROM students WHERE id = '$id'");
    
            if (mysqli_num_rows($checkUser) > 0) {    
                // Update record in the students table
                $updateQuery = "UPDATE students SET
                                    `first_name` = '$first_name',
                                    `last_name` = '$last_name',
                                    `email` = '$email',
                                    `gender` = '$gender',
                                    `phone` = '$phone',
                                    `level` = '$level'
                                WHERE id = $id";
    
                if ($conn->query($updateQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Student record updated successfully!";
                    session_write_close();
                    header("Location: /students/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error inserting record: " . $conn->error . "
                        </div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                    Student does not exist
                </div>";  
            }
        }
    }
?>