<?php
    session_start();
    
    require_once '../components/db_connect.php';

    $card = "";
    $reviewsHtml = "";
    
    if(isset($_GET['id']) && !empty($_GET["id"])){

        //get session recipe id
        $_SESSION["sessionid"] = $_GET["id"];
        $recipeid = $_SESSION["sessionid"];


        $sql = "SELECT * FROM `recipes` WHERE `id_recipe` = $_GET[id]";
        $result = mysqli_query($connection, $sql);    

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Check if the user is logged in
            $reviewButton = isset($_SESSION['user']) ? "<button type='button' name='add_review' id='add_review' class='btn btn-outline-primary'><i class='fa-solid fa-magnifying-glass'></i> &nbsp; Review</button>" : "";
            $card = "
            <section class='team-section py-5'>
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
                                        <h5 class='member-name mb-3 text-center text-primary font-weight-bold'>{$row["categories"]}</h5>
                                        <div class='mb-2 text-center'>Preparation Time: {$row["prepTime"]}</div>
                                        <div class='mb-4 text-center'>Calories: {$row["calories"]}</div>
            
                                        <div class='mb-4'>
                                            <strong>Description:</strong>
                                            <p>{$row["description"]}</p>
                                        </div>
            
                                        <div class='mb-4'>
                                            <strong>Ingredients:</strong>
                                            <p>{$row["ingredients"]}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>  <!--//card-->
                        </div>  <!--//col-->
                    </div>
                </div>
            </section>
            


            <div class='container'>
    	<div class='card'>
    		<div class='card-header'><{$row["name_recipe"]}></div>
    		<div class='card-body'>
    			<div class='row'>
    				<div class='col-sm-4 text-center'>
    					<h1 class='text-warning mt-4 mb-4'>
    						<b><span id='average_rating'>0.0</span> / 5</b>
    					</h1>
    					<div class='mb-3'>
    						<i class='fas fa-star star-light mr-1 main_star'></i>
                            <i class='fas fa-star star-light mr-1 main_star'></i>
                            <i class='fas fa-star star-light mr-1 main_star'></i>
                            <i class='fas fa-star star-light mr-1 main_star'></i>
                            <i class='fas fa-star star-light mr-1 main_star'></i>
	    				</div>
    					<h3><span id='total_review'>0</span> Review</h3>
    				</div>
    				<div class='col-sm-4'>
    					<p>
                            <div class='progress-label-left'><b>5</b> <i class='fas fa-star text-warning'></i></div>

                            <div class='progress-label-right'>(<span id='total_five_star_review'>0</span>)</div>
                            <div class='progress'>
                                <div class='progress-bar bg-warning' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' id='five_star_progress'></div>
                            </div>
                        </p>
    					<p>
                            <div class='progress-label-left'><b>4</b> <i class='fas fa-star text-warning'></i></div>
                            
                            <div class='progress-label-right'>(<span id='total_four_star_review'>0</span>)</div>
                            <div class='progress'>
                                <div class='progress-bar bg-warning' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' id='four_star_progress'></div>
                            </div>               
                        </p>
    					<p>
                            <div class='progress-label-left'><b>3</b> <i class='fas fa-star text-warning'></i></div>
                            
                            <div class='progress-label-right'>(<span id='total_three_star_review'>0</span>)</div>
                            <div class='progress'>
                                <div class='progress-bar bg-warning' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' id='three_star_progress'></div>
                            </div>               
                        </p>
    					<p>
                            <div class='progress-label-left'><b>2</b> <i class='fas fa-star text-warning'></i></div>
                            
                            <div class='progress-label-right'>(<span id='total_two_star_review'>0</span>)</div>
                            <div class='progress'>
                                <div class='progress-bar bg-warning' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' id='two_star_progress'></div>
                            </div>               
                        </p>
    					<p>
                            <div class='progress-label-left'><b>1</b> <i class='fas fa-star text-warning'></i></div>
                            
                            <div class='progress-label-right'>(<span id='total_one_star_review'>0</span>)</div>
                            <div class='progress'>
                                <div class='progress-bar bg-warning' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' id='one_star_progress'></div>
                            </div>               
                        </p>
    				</div>
    				<div class='col-sm-4 text-center'>
    					<h3 class='mt-4 mb-3'>See Reviews for {$row["name_recipe"]} here!</h3>
    					{$reviewButton}
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class='mt-5' id='review_content'></div>
    </div>
   ";
            
        } else {
            $card = "no data found";
        }
    }
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/details_styles.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
    <!-- AJAX  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>

<body>
    <!-- navbar -->
    <?php 
    $loc = '../';
    require_once '../components/navbar.php';
    ?>

    <!-- start content -->
    <div class="">
        <?= $card; ?>  
    </div>
    
    
    <!-- end content -->

    <!-- footer -->
    <div>
    <?php 
    $loc = "../";
    require_once "../components/footer.php"; ?>
    </div>

    <!-- Bootstrap Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<!-- Code for reveiw - Please leave it like this -->

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-2">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        	<div class="form-group">
	        		<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
	        	</div>
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>

<style>
.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
	color:#e9ecef;
}
</style>

<script>

$(document).ready(function(){

	var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        var user_name = $('#user_name').val();

        var user_review = $('#user_review').val();

        if(user_name == '' || user_review == '')
        {
            alert("Please Fill Both Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data()
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:
            {
            action:'load_data',
            recipe_id: <?php echo $_GET['id']; ?>
            },
            dataType:"JSON",
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }

});

</script>