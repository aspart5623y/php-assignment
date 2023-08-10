<?php 
    include_once "../common/header.php";
    include_once "../config/db_connect.php";
    include_once "../common/validation.php";
    ?>
    <div class="container my-5">
        
        <div class="d-flex align-items-center mb-5">
            <a href="/guests/" class="text-decoration-none">
                <h3 class="text-muted">Guests</h3>
            </a> 
            <h4 class="text-danger">
                &nbsp;
                /
                Edit Guest
            </h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-body bg-light">
                    <form method="POST">
                        <?php include "../backend/guests/update.php" ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="" name="first_name" value="<?php echo $first_name ?>" placeholder="John">
                                    <?php if (isset($errors['first_name'])) echo "<div class='text-danger'>" . $errors['first_name'] . "</div>"; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="" name="last_name" value="<?php echo $last_name ?>" placeholder="Doe">
                                    <?php if (isset($errors['last_name'])) echo "<div class='text-danger'>" . $errors['last_name'] . "</div>"; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Gender</label>
                                    <select class="form-select" name="gender">
                                        <option value="">select option</option>
                                        <option value="male" <?php echo $gender == 'male' ? 'selected' : '' ?>>male</option>
                                        <option value="female" <?php echo $gender == 'female' ? 'selected' : '' ?>>female</option>
                                    </select>
                                    <?php if (isset($errors['gender'])) echo "<div class='text-danger'>" . $errors['gender'] . "</div>"; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="" name="email" value="<?php echo $email ?>" placeholder="mail@example.com">
                                    <?php if (isset($errors['email'])) echo "<div class='text-danger'>" . $errors['email'] . "</div>"; ?>
                                </div>  
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="" name="phone" value="<?php echo $phone ?>" placeholder="+1234567890">
                                    <?php if (isset($errors['phone'])) echo "<div class='text-danger'>" . $errors['phone'] . "</div>"; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Room</label>
                                    <input type="text" class="form-control" id="" name="room" value="<?php echo $room ?>" placeholder="101">
                                    <?php if (isset($errors['room'])) echo "<div class='text-danger'>" . $errors['room'] . "</div>"; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Check in Date</label>
                                    <input type="date" class="form-control" id="" name="check_in_date" value="<?php echo $check_in_date ?>" placeholder="Lawyer">
                                    <?php if (isset($errors['check_in_date'])) echo "<div class='text-danger'>" . $errors['check_in_date'] . "</div>"; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Check out Date</label>
                                    <input type="date" class="form-control" id="" name="check_out_date" value="<?php echo $check_out_date ?>" placeholder="Lawyer">
                                    <?php if (isset($errors['check_out_date'])) echo "<div class='text-danger'>" . $errors['check_out_date'] . "</div>"; ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once "../common/footer.php" ?>
