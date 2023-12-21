<?php
echo "
<!-- Footer Start -->
<footer>
<div class='container-bg text-light footer mt-5 py-5 wow fadeIn' data-wow-delay='0.1s'>
    <div class='container-fluid mx-0'>
        <div class='row footer-sec '>
            <div class='offset-md-1 col-md-3 mt-2'>
                <h4 class='text-white mb-4'>Our Office</h4>
                <p class='mb-2'><i class='fa fa-map-marker-alt me-3'></i>1010 Karlsplatz, Vienna, Austria</p>
                <p class='mb-2'><i class='fa fa-phone-alt me-3'></i>+66 987 654 3210</p>
                <p class='mb-2'><i class='fa fa-envelope me-3'></i>info@example.com</p>
                <div class='d-flex pt-2'>
                    <a class='btn btn-square btn-outline-light rounded-circle me-2' href=''><i class='fab fa-twitter'></i></a>
                    <a class='btn btn-square btn-outline-light rounded-circle me-2' href=''><i class='fab fa-facebook-f'></i></a>
                    <a class='btn btn-square btn-outline-light rounded-circle me-2' href=''><i class='fab fa-youtube'></i></a>
                    <a class='btn btn-square btn-outline-light rounded-circle me-2' href=''><i class='fab fa-linkedin-in'></i></a>
                </div>
            </div>
            <div class='col-md-3 mt-2'>
                <h4 class='text-white mb-4'>Business Hours</h4>
                <p class='mb-2'>Monday-Friday</p>
                <span>09:00 am - 07:00 pm</span>
                <p class='mb-2'>Saturday</p>
                <span>09:00 am - 12:00 pm</span>
                <p class='mb-2'>Sunday</p>
                <span>Closed</span>
            </div>
            <div class='col-md-3 mt-2'>
                <h4 class='text-white mb-4'>Quick Links</h4>";

if (isset($_SESSION['user']) || isset($_SESSION['adm'])) {
    echo "<a class='btn btn-link' href='{$loc}index.php'>Home</a>";
    echo "<a class='btn btn-link' href='{$loc}login/logout.php'>Logout</a>";
    echo "<a class='btn btn-link' href='{$loc}recipes.php'>Recipes</a>";
    echo "<a class='btn btn-link' href='{$loc}about_us.php'>About us</a>";
    echo "<a class='btn btn-link' href='{$loc}contact_us.php'>Contact Us</a>";
} else {
    echo "

                <a class='btn btn-link' href='{$loc}index.php'>Home</a>
                <a class='btn btn-link' href='{$loc}login/login_register.php'>Register</a>
                <a class='btn btn-link' href='{$loc}recipes.php'>Recipes</a>
                <a class='btn btn-link' href='{$loc}about_us.php'>About us</a>
                <a class='btn btn-link' href='{$loc}contact_us.php'>Contact Us</a>";
}
echo "
              </div>
            </div>
        </div>
    </div>
</div>
<div>
<p class='copyright-section'>CopyRight &copy;2023</p>
</div>
<div>
</footer>
<!-- Footer End -->
";
