<?php require_once "db.php";

    $events = selectAll('events');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trybae | Contact Us</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style_contact.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style_nav.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style_footer.css">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar Code -->

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

</head>

<body>

    <!-- Navbar Start  -->
    <?php
include_once ("includes_ui/navbar_ui.php");
?>

    <!-- Navbar Ends -->

    <!-- contact section starts  -->

    <div class="content">

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="row align-items-center">
                        <div class="col-lg-7 mb-5 mb-lg-0">

                            <h2 class="mb-5">Fill the form. <br> It's easy.</h2>

                            <form class="border-right pr-5 mb-5" method="post" id="contactForm" name="contactForm">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First name">
                                    </div>
                                    <br>
                                    
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name">
                                    </div>
                                </div>
                                <br>
                                
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <br>
                                
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <textarea class="form-control" name="message" id="message" cols="30" rows="7" placeholder="Write your message"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" value="Send Message" class="btn btn-primary">
                                        <span class="submitting"></span>
                                    </div>
                                </div>
                            </form>

                            <div id="form-message-warning mt-4"></div>
                            <div id="form-message-success">
                                Your message was sent, thank you!
                            </div>

                        </div>
                        <div class="col-lg-4 ml-auto">
                            <h3 class="mb-4">Let's talk about everything.</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil deleniti itaque similique magni. Magni, laboriosam perferendis maxime!</p>
                            <p><a href="#">Read more</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- custom js file link  -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
