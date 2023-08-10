<?php
    global $conn;
    
    $first_name = $last_name = $gender = $email = $phone = $level = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = validateAndSanitize($_POST['first_name'], $errors, 'first_name', "First name is required");
        $last_name = validateAndSanitize($_POST['last_name'], $errors, 'last_name', "Last name is required");
        $gender = validateAndSanitize($_POST['gender'], $errors, 'gender', "Gender is required");
        $email = validateAndSanitize($_POST['email'], $errors, 'email', "Email is required", false, true); // Added true here for email validation
        $phone = validateAndSanitize($_POST['phone'], $errors, 'phone', "Phone is required", true);
        $level = validateAndSanitize($_POST['level'], $errors, 'level', "level is required");

        
        if (empty($errors)) {
            $tableExistsQuery = "SHOW TABLES LIKE 'students'";
            $tableExistsResult = $conn->query($tableExistsQuery);
    
            if ($tableExistsResult->num_rows === 0) {
                // Create the students table
                $createTableQuery = "
                    CREATE TABLE students (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        first_name VARCHAR(50) NOT NULL,
                        last_name VARCHAR(50) NOT NULL,
                        gender ENUM('male', 'female', 'other') NOT NULL,
                        email VARCHAR(100) NOT NULL,
                        phone VARCHAR(20) NOT NULL,
                        level VARCHAR(100) NOT NULL
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
    
    
            $checkUser = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email'");
    
            if (mysqli_num_rows($checkUser) > 0) {
                echo "<div class='alert alert-danger' role='alert'>
                        Student already exist
                    </div>";      
            } else {
                // Insert record into the students table
                $insertQuery = "INSERT INTO students (`first_name`, `last_name`, `gender`, `email`, `phone`, `level`)
                                VALUES ('$first_name', '$last_name', '$gender', '$email', '$phone', '$level');";
    
                if ($conn->query($insertQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Student record added successfully!";
                    session_write_close();
                    header("Location: /students/index.php");
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