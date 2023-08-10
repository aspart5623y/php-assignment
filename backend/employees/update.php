<?php
    global $conn;

    // Fetch employee details
    $id = $_GET['id'];
    $query = "SELECT * FROM employees WHERE id=$id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $gender = $data['gender'];
    $email = $data['email'];
    $phone = $data['phone'];
    $job_title = $data['job_title'];
    $salary = $data['salary'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = validateAndSanitize($_POST['first_name'], $errors, 'first_name', "First name is required");
        $last_name = validateAndSanitize($_POST['last_name'], $errors, 'last_name', "Last name is required");
        $gender = validateAndSanitize($_POST['gender'], $errors, 'gender', "Gender is required");
        $email = validateAndSanitize($_POST['email'], $errors, 'email', "Email is required", false, true); // Added true here for email validation
        $phone = validateAndSanitize($_POST['phone'], $errors, 'phone', "Phone is required", true);
        $job_title = validateAndSanitize($_POST['job_title'], $errors, 'job_title', "Job title is required", false);
        $salary = validateAndSanitize($_POST['salary'], $errors, 'salary', "Salary is required", true);

        if (empty($errors)) {    
            $checkUser = mysqli_query($conn, "SELECT * FROM employees WHERE id = '$id'");
    
            if (mysqli_num_rows($checkUser) > 0) {    
                // Update record in the employees table
                $updateQuery = "UPDATE employees SET
                                    first_name = '$first_name',
                                    last_name = '$last_name',
                                    email = '$email',
                                    gender = '$gender',
                                    phone = '$phone',
                                    job_title = '$job_title',
                                    salary = '$salary'
                                WHERE id = $id";
    
                if ($conn->query($updateQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Employee record updated successfully!";
                    session_write_close();
                    header("Location: /employees/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error inserting record: " . $conn->error . "
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