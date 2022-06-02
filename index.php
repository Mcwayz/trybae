<!-- Header Start -->
<?php include "includes_ui/header.php"; 
#<!-- Navbar Start  -->
include_once ("includes_ui/navbar_ui.php");
?>

<div class="hero" style="background-image: url('images/hero_home.jpg');"></div>

<!-- Navbar Ends -->

<!-- Upcoming Events  -->

<section class="price" id="price">

    <h1 class="heading"><span>UpcomingS Events</span> </h1>

    <br/> <br/>

    <div class="box-container">
        
           <?php while($upcoming = $upcoming_events->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="box">
                    <h3 class="title"><?=$upcoming['event_name'];?></h3>
                    <br/>
                    <?php $imge = $upcoming['images'];?>
                    <img src="admin/uploads/<?=$imge;?>" alt="" style="width:200px">
                    <br/>
                    <h3 class="amount"><a href="#">K<?=$upcoming['vip'];?></a></h3>
                    <a href="pay.php?id=<?=$upcoming['id'];?>&amount=<?=$upcoming['vip'];?>" class="btn btn-primary">Purchase Ticket</a>
                    <br/>
                    <a href="contact.html" button type="button" class="btn btn-light">View Info</button></a>
                </div>
            <?php endwhile; ?>        
            
    </div>


</section>

<!-- Events Section Ends -->

<!-- footer section starts  -->
<?php
include_once ("includes_ui/footer_ui.php");
?>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/main.js"></script>
<script src="js/script.js"></script>

</body>
</html>