<?php
echo "
<nav class='navbar navbar-expand-lg'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='{$loc}index.php' id='href'><img src='{$loc}images/logo.png' id='logo'style='margin: 1vh;'></a>

    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>";

echo "</ul>"; // Closing the left-aligned navbar links

// Right-aligned navbar links
echo "<ul class='navbar-nav ml-auto'>";

echo "
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}recipes.php' id='recipes'>Recipes</a>
        </li>";

if(isset($_SESSION['adm'])){
    echo "
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}login/user_dashboard.php' id='user_dashboard'>User Dashboard</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}recipes/recipes_dashboard_admin.php' id='recipes_dashboard'>Recipes Dashboard</a>
        </li>";
}

if(isset($_SESSION['user'])){
    echo "
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}recipes/recipes_dashboard.php' id='your_recipes'>Your Recipes</a>
        </li>";
}

if(isset($_SESSION['user']) || isset($_SESSION['adm'])){
    echo "
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}recipes/create.php' id='create'>Create Recipes</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}meal_planer/meal_planer.php' id='planer'>Meal Planner</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}login/update.php'  id='login_update'>Update your profile</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}login/logout.php'  id='logout'>Log out</a>
        </li>";
} else {
    echo "
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='{$loc}login/login_register.php' id='login'>Log in/Register</a>
        </li>";
}

if(isset($_SESSION['user']) || isset($_SESSION['adm'])){
    echo "
        <li class='profilimg'>
            <div id='img'>
                <img src='{$loc}images/$_SESSION[img]' alt='User Image' style='height: 6vh; width: 6vh; object-fit: cover; border-radius: 50vh; margin: 1vh;'>
            </div>
        </li>";
}

echo "</ul>"; 
echo "</div></div></nav>";
?>
