<?php
    global $conn;
    $first_name = $last_name = $gender = $email = $phone = $job_title = $salary = ""; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = validateAndSanitize($_POST['first_name'], $errors, 'first_name', "First name is required");
        $last_name = validateAndSanitize($_POST['last_name'], $errors, 'last_name', "Last name is required");
        $gender = validateAndSanitize($_POST['gender'], $errors, 'gender', "Gender is required");
        $email = validateAndSanitize($_POST['email'], $errors, 'email', "Email is required", false, true); // Added true here for email validation
        $phone = validateAndSanitize($_POST['phone'], $errors, 'phone', "Phone is required", true);
        $job_title = validateAndSanitize($_POST['job_title'], $errors, 'job_title', "Job title is required", false);
        $salary = validateAndSanitize($_POST['salary'], $errors, 'salary', "Salary is required", true);

        if (empty($errors)) {
            $tableExistsQuery = "SHOW TABLES LIKE 'employees'";
            $tableExistsResult = $conn->query($tableExistsQuery);
    
            if ($tableExistsResult->num_rows === 0) {
                // Create the employees table
                $createTableQuery = "
                    CREATE TABLE employees (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        first_name VARCHAR(191) NULL,
                        last_name VARCHAR(191) NULL,
                        email VARCHAR(100) NULL,
                        gender ENUM('male', 'female') NULL,
                        phone VARCHAR(100) NULL,
                        job_title VARCHAR(100) NULL,
                        salary VARCHAR(100) NULL
                    );                
                ";
            
                if ($conn->query($createTableQuery) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>
                            Table created successfully
                        </div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error creating table: " . $conn->error . "
                        </div>";
                }
            }
    
    
            $checkUser = mysqli_query($conn, "SELECT * FROM employees WHERE email = '$email'");
    
            if (mysqli_num_rows($checkUser) > 0) {
                echo "<div class='alert alert-danger' role='alert'>
                        Employee already exist
                    </div>";      
            } else {
                // Insert record into the employees table
                $insertQuery = "INSERT INTO employees (first_name, last_name, email, gender, phone, job_title, salary)
                                VALUES ('$first_name', '$last_name', '$email', '$gender', '$phone', '$job_title', '$salary')";
    
                if ($conn->query($insertQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Employee record added successfully!";
                    session_write_close();
                    header("Location: /employees/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error inserting record: " . $conn->error . "
                        </div>";
                }
            }
        }


    }
?>