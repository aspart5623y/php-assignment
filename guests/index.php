<?php 
    include_once "../common/header.php";
    include_once "../config/db_connect.php";    
    // include_once "../config/formatNumber.php";    
?>
    <div class="container my-5">
        <div class="mb-5 d-flex flex-wrap justify-content-between">
            <h1 class="text-danger mb-0">Guests</h1>
            <a href="/guests/create.php" class="btn btn-success px-4 d-flex align-items-center">
                Create new
                &nbsp;
                <i class="fa fa-plus"></i>
            </a>
        </div>

        <?php include_once '../common/message.php' ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col text-nowrap">First Name</th>
                        <th scope="col text-nowrap">Last Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Room</th>
                        <th scope="col text-nowrap">Check-in Date</th>
                        <th scope="col text-nowrap">Check-out Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $tableExistsQuery = "SHOW TABLES LIKE 'guests'";
                    $tableExistsResult = $conn->query($tableExistsQuery);

                    if (!($tableExistsResult->num_rows === 0)) {
                        $query = mysqli_query($conn, 'SELECT * FROM guests');
                        $rows = mysqli_num_rows($query);
    
                        if ($rows > 0) {
                            $sn = 1;
                            while ($data = mysqli_fetch_array($query)){
                ?> 
                    <tr>
                        <th scope="row"><?php echo $sn++ ?></th>
                        <td><?php echo $data['first_name'] ?></td>
                        <td><?php echo $data['last_name'] ?></td>
                        <td><?php echo $data['gender'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td><?php echo $data['phone'] ?></td>
                        <td><?php echo $data['room'] ?></td>
                        <td><?php echo $data['check_in_date'] ?></td>
                        <td><?php echo $data['check_out_date'] ?></td>
                        <td class="text-nowrap">
                            <a href="/guests/edit.php?id=<?php echo $data['id'] ?>" class="btn btn-primary">
                                <i class="far fa-edit"></i>
                            </a>
                            &nbsp;
                            <a href="/guests/delete.php?id=<?php echo $data['id'] ?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        ?> 
                        <!-- tabel row -->
                        <tr>
                            <!-- s/n -->
                            <td colspan="10" class="text-center">No record found!</td>
                        </tr>
                    <?php }} else {
                        ?>
                        <!-- tabel row -->
                        <tr>
                            <!-- s/n -->
                            <td colspan="10" class="text-center">No record found!</td>
                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include_once "../common/footer.php" ?>
