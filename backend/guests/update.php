<?php
    global $conn;

    // Fetch employee details
    $id = $_GET['id'];
    $query = "SELECT * FROM guests WHERE id=$id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $gender = $data['gender'];
    $email = $data['email'];
    $phone = $data['phone'];
    $room = $data['room'];
    $check_in_date = $data['check_in_date'];
    $check_out_date = $data['check_out_date'];


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
            $checkUser = mysqli_query($conn, "SELECT * FROM guests WHERE id = '$id'");
    
            if (mysqli_num_rows($checkUser) > 0) {    
                // Update record in the guests table
                $updateQuery = "UPDATE guests SET
                                    first_name = '$first_name',
                                    last_name = '$last_name',
                                    email = '$email',
                                    gender = '$gender',
                                    phone = '$phone',
                                    room = '$room',
                                    check_in_date = '$check_in_date',
                                    check_out_date = '$check_out_date'
                                WHERE id = $id";
    
                if ($conn->query($updateQuery) === TRUE) {
                    session_start();
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Guest record updated successfully!";
                    session_write_close();
                    header("Location: /guests/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger' role='alert'>
                            Error inserting record: " . $conn->error . "
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