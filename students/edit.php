<?php 
    include_once "../common/header.php";
    include_once "../config/db_connect.php";
    include_once "../common/validation.php";
    ?>
    <div class="container my-5">
        
        <div class="d-flex align-items-center mb-5">
            <a href="/students/" class="text-decoration-none">
                <h3 class="text-muted">Students</h3>
            </a> 
            <h4 class="text-danger">
                &nbsp;
                /
                Edit Student
            </h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-body bg-light">
                    <form method="POST">
                        <?php include "../backend/students/update.php" ?>
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
                                    <label for="" class="form-label">Level</label>
                                    <select class="form-select" name="level">
                                        <option value="">select menu</option>
                                        <option value="nd1" <?php echo $level == 'nd1' ? 'selected' : '' ?>>ND1</option>
                                        <option value="nd2" <?php echo $level == 'nd2' ? 'selected' : '' ?>>ND2</option>
                                        <option value="it" <?php echo $level == 'it' ? 'selected' : '' ?>>IT</option>
                                        <option value="hnd1" <?php echo $level == 'hnd1' ? 'selected' : '' ?>>HND1</option>
                                        <option value="hnd2" <?php echo $level == 'hnd2' ? 'selected' : '' ?>>HND2</option>
                                    </select>
                                    <?php if (isset($errors['level'])) echo "<div class='text-danger'>" . $errors['level'] . "</div>"; ?>
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
