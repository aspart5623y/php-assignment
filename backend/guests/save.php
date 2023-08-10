<?php
    global $conn;
    
    $first_name = $last_name = $gender = $email = $phone = $room = $check_in_date = $check_out_date = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = validateAndSanitize($_POST['first_name'], $errors, 'first_name', "First name is required");
        $last_name = validateAndSanitize($_POST['last_name'], $errors, 'last_name', "Last name is required");
        $gender = validateAndSanitize($_POST['gender'], $errors, 'gender', "Gender is required");
        $email = validateAndSanitize($_POST['email'], $errors, 'email', "Email is required", false, true); // Added true here for email validation
        $phone = validateAndSanitize($_POST['phone'], $errors, 'phone', "Phone is required", true);
        $room = validateAndSanitize($_POST['room'], $errors, 'room', "Room is required", true);
        $check_in_date = validateAndSanitize($_POST['check_in_date'], $errors, 'check_in_date', "Check in date is required", false);
        $check_out_date = validateAndSanitize($_POST['check_out_date'], $errors, 'check_out_date', "Check out date is required", false);

        if (empty($errors)) {
            $tableExistsQuery = "SHOW TABLES LIKE 'guests'";
            $tableExistsResult = $conn->query($tableExistsQuery);
    
            if ($tableExistsResult->num_rows === 0) {
                // Create the guests table
                $createTableQuery = "
                    CREATE TABLE guests (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        first_name VARCHAR(50) NOT NULL,
                        last_name VARCHAR(50) NOT NULL,
                        gender ENUM('male', 'female', 'other') NOT NULL,
                        email VARCHAR(100) NOT NULL,
                        phone VARCHAR(20) NOT NULL,
                        room VARCHAR(10) NOT NULL,
                        check_in_date DATE NOT NULL,
                        check_out_date DATE NOT NULL
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
    
    
            $checkUser = mysqli_query($conn, "SELECT * FROM guests WHERE email = '$email'");
    
            if (mysqli_num_rows($checkUser) > 0) {
                echo "<div class='alert alert-danger' role='alert'>
                        Guest already exist
                    </div>";      
            } else {
                // Insert record into the guests table
                $insertQuery = "INSERT INTO guests (first_name, last_name, gender, email, phone, room, check_in_date, check_out_date)
                                VALUES ('$first_name', '$last_name', '$gender', '$email', '$phone', '$room', '$check_in_date', '$check_out_date');";
    
                if ($conn->query($insertQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Guest record added successfully!";
                    session_write_close();
                    header("Location: /guests/index.php");
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