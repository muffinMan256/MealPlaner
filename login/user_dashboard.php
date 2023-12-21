<?php
session_start();

if (!isset($_SESSION["adm"])) {
    header("Location: ./index.php");
}

require_once '../components/db_connect.php';

// Query to get the count of new users
// new_user is set to 1 in the database when a user is created
$sqlNewUsers = "SELECT COUNT(*) AS newUsersCount FROM user WHERE `status` != 'adm' AND `new_user` = 1";
$resultNewUsers = mysqli_query($connection, $sqlNewUsers);
$newUsersCount = 0;

if ($resultNewUsers) {
    $rowNewUsers = mysqli_fetch_assoc($resultNewUsers);
    $newUsersCount = $rowNewUsers['newUsersCount'];

    // Reset new_user flag to 0 for all new users
    if ($newUsersCount > 0) {
        $resetNewUsersQuery = "UPDATE user SET `new_user` = 0 WHERE `status` != 'adm' AND `new_user` = 1";
        $resultResetNewUsers = mysqli_query($connection, $resetNewUsersQuery);

        if ($resultResetNewUsers) {
            // The update was successful
        } else {
            // The update failed
        }
    }
}

$sql = "SELECT * FROM user WHERE `status` != 'adm'";
$result = mysqli_query($connection, $sql);
$data = "";

// alerts
$updateSuccess = false;
$updateFailure = false;

if (mysqli_num_rows($result) > 0) {
    // Inside the while loop
    while ($row = mysqli_fetch_assoc($result)) {
        $blockButton = '<a href="./blocked.php?id=' . $row['id_user'] . '" class="btn btn-outline-danger"> <i class="fa-solid fa-circle-xmark"></i>&nbsp; Block</a>';
        $unblockButton = '<a href="./unblocked.php?id=' . $row['id_user'] . '" class="btn btn-outline-success"> <i class="fa-solid fa-check"></i>&nbsp; Unblock</a>';

        $blockAction = $row['blocked'] == 0 ? $blockButton : $unblockButton;

        $data .= "
        <div class='container align-content-center '>
            <tr>
                <td style='width: 15%'>$row[first_name]</td>
                <td style='width: 15%'>$row[last_name]</td>
                <td style='width: 30%'>$row[email]</td>
                <td style='width: 18%'>
                    <div class='btn-group'>
                        <a href='./update.php?id=$row[id_user]' class='btn btn-outline-warning'> <i class='fa-solid fa-square-pen'></i>&nbsp; Update</a>
                        $blockAction
                    </div>
                </td>
            </tr>
        </div>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planer - User Dashboard</title>
    <!-- bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/user_dash_styles.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../components/fontawesome/css/all.css">
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <!-- Navbar Test Brand-->
    <!-- Please leave this here-->
    <!-- 
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"> 
                    <a class="navbar-brand ps-3" href="../index.html"><i class="fa-solid fa-house"></i></a>
                    <a class="navbar-brand ps-3"> 
                        Logged in as: 

                    </a>
                    <a class="navbar-brand ps-3" href="../login/user_dashboard.php">User Dashboard</i></a>
                    <a class="navbar-brand ps-3" href="../recipes/recipes_dashboard.php">Recipes Dashboard</i></a>
                    <a class="navbar-brand ps-3" href="../recipes/create.php">Create Recipes</i></a>
                    <a class="navbar-brand ps-3" href="../login/update.php">Update Profile</i></a>
                    <a class="navbar-brand ps-3" href="../recipes/create.php">Log Out</i></a> 
            </nav>
            -->
    <!-- Navbar-->
    <div> <?php $loc = "../";
            require_once '../components/navbar.php'; ?></div>

    <!-- start content -->
            <h2 class="text-center mt-3 mb-4">Welcome to the User Dashboard, Admin!</h2>
            
        <!-- Display new users and new recipes counts -->
        <div class="container mt-3 mb-3">
                <div class="col-md-2">
                        <p class="card-text"><?= $newUsersCount ?> new users added</p>
                </div>
            </div>
        <div class="container">
            <div class="text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">First Name</th>
                            <th class="text-center" scope="col">Last Name</th>
                            <th class="text-center" scope="col">E-Mail</th>
                            <th class="text-center" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $data; ?>
                        <?php if (mysqli_num_rows($result) == 0) : ?>
                            <tr>
                                <td colspan="3" class="text-center">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    
    <!-- end content -->

    <!-- footer -->
    <?php
    $loc = "../";
    require_once "../components/footer.php"; ?>

    <!-- SweetAlert for Success -->
    <?php if ($updateSuccess) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update successful',
            }).then(function() {
                window.location = "./user_dashboard.php";
            });
        </script>
    <?php endif; ?>

    <!-- SweetAlert for Failure -->
    <?php if ($updateFailure) : ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            }).then(function() {
                window.location = "./user_dashboard.php";
            });
        </script>
    <?php endif; ?>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>