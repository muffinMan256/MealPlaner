<?php
session_start();

require_once '../components/db_connect.php';

// Count variable
$recipesToProofCount = 0;

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ./index.php");
    exit;
}

// get the recipes of the user which is logged in
if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"];
    $sql = "SELECT * FROM `recipes` WHERE fk_user = ?";
    $types = "i"; // 'i' stands for integer
    $params = [&$user_id];
}
// get the recipes of the user which is logged in
elseif (isset($_SESSION["adm"])) {
    $sql = "SELECT * FROM `recipes`";
    $types = "";
    $params = [];
}

// filter the cards
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['toProof'])) {
        $sql = "SELECT * FROM `recipes` WHERE proofed = false";
    } elseif (isset($_POST['showAll'])) {
        $sql = "SELECT * FROM `recipes`";
    }
}

// Prepare and execute SQL query
$stmt = $connection->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$cards = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cards .= "
            <section class='team-section'>
                <div class='container'>
                    <div class='row justify-content-center'>
                        <div class='col-12 col-md-6'>
                            <div class='card border-0 shadow-lg pt-5 my-5 position-relative'>
                                <div class='card-body p-4'>
                                    <div class='w-100 text-center'>
                                        <img class='rounded-circle mb-2 d-inline-block shadow-sm' src='../images/{$row["img_recipe"]}' alt='{$row["name_recipe"]}'>
                                    </div> 
                                    <div class='card-text pt-1'>
                                        <h5 class='member-name mt-5 mb-3 text-center text-primary font-weight-bold'>{$row["name_recipe"]}</h5>
                                        <div class='mb-3 text-center'>Preparation Time: $row[prepTime]</div>
                                    </div>
                                </div><!--//card-body-->
                                <div class='card-footer theme-bg-primary border-0 text-center'>
                                    <ul class='social-list list-inline mb-0 mx-auto'>
                                        <div class='d-flex justify-content-between mb-2'>
                                            <a href='details.php?id=$row[id_recipe]' class='btn btn-outline-success'><i class='fa-solid fa-circle-info'></i> &nbsp; read more...</a>
                                            
                                            <a href='update.php?id=$row[id_recipe]' class='btn btn-outline-warning'><i class='fa-solid fa-pen-nib'></i> &nbsp; Update</a>
                                            
                                            <button onclick='confirmDelete({$row["id_recipe"]})' class='btn btn-outline-danger'><i class='fa-solid fa-trash'></i> &nbsp; Delete</button>
                                        </div>
                                    ";
        // if admin show the recipes to proof and proofed checkbox
        if (isset($_SESSION["adm"]) &&  !$row['proofed']) {
            $recipesToProofCount++;
            $cards .= "
                        
                                                <a href='proofed.php?id=$row[id_recipe]' class='btn btn-outline-info' style='width: 100%; text-transform: uppercase;'><i class='fa-solid fa-check'></i> &nbsp; Proof</a>
                                            ";
        }
        $cards .= "</ul>
                                </div><!--//card-footer-->
                            </div><!--//card-->
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//container-->
            </section>";
    }
} else {
    $cards = "no data found";
}

$stmt->close();
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planer - Your Recipes</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/recipes_dash_styles.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <?php
    $loc = "../";
    require_once "../components/navbar.php"; ?>

    <!-- start content -->
    <div class="text-center mt-5" style="width: 100%;">
        <form action="" method="POST">
            <!-- show all -->
            <input type="submit" value="To proof" name="toProof" id="btn" class="btn btn-success px-5 toProof" style="background-color: #C3BF6D; border: none; text-transform: uppercase;">
            <!-- show to proof -->
            <input type="submit" value="Show all" name="showAll" id="btn" class="btn btn-success px-5 showAll" style="background-color: #C3BF6D; border: none; text-transform: uppercase;">
        </form>
    </div>

    <!-- Display the count above the recipe cards -->
    <div class="container">
        <div class="text-center mt-3">
            <?php
            if (isset($_SESSION["adm"])) {
                echo "<p>Recipes to be proofed: $recipesToProofCount</p>";
            }
            ?>
        </div>
        <?= $cards; ?>
    </div>
    <!-- end content -->

    <!-- footer -->
    <?php
    $loc = "../";
    require_once "../components/footer.php"; ?>

    <!-- SweetAlert for Delete Success -->
    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete.php?id=' + id;
            }
        })
    }
    </script>

    <!-- Bootstrap Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>