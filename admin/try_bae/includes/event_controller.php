<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

//Instance of the class
require_once 'model.php';
require_once 'database.php';  
$model = new model();

$errors  = array();

if (isset($_GET['id'])) {
   $event = selectOne($table, ['id' => $_GET['id']]);
   $id = $event['id'];
   $title = $story['title'];
   $body = $story['body'];
   $title1 = $story['sub_head1'];
   $body1 = $story['sub_body1'];
   $title2 = $story['sub_head2'];
   $body2 = $story['sub_body2'];
   $topic_id = $story['topic_id'];

   $breaking =  $event['B_N'];
   $user_id = $event['user_id'];
   $event_name = $event['event_name'];
   $address =  $event['address'];
   $email = $event['email'];
   $phone_number=  $event['phone_number'];
   $limits = $event['limits'];
   $age_id =  intval($_POST = $event['times']);
   $ordinary =  $event['ordinary'];
   $vip =  $event['vip'];
   $add_info =  $event['add_info'];
   $published = $event['published'];
}


if (isset($_GET['delete_id'])) {
   $count = delete($table, $_GET['delete_id']);
   $_SESSION['message'] = "Story Delete Successfully";
   $_SESSION['type'] = "success";
   header("Location: ../admin_author/view-posts.php");
   exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
   $published = $_GET['published'];
   $id = intval($_GET['p_id']);
   $count =  changeState($id, $published);
   $_SESSION['message'] = "Story Published Successfully";
   $_SESSION['type'] = "success";
   header("Location: ../admin_author/view-posts.php");
   exit();
}
 


if (isset($_POST['add-event'])) {

   if (!empty($_FILES['event_image']['name'])) {
      $image = time() . '_' . $_FILES['event_image']['name'];
      $destination = "../uploads/".$image;
      $result = move_uploaded_file($_FILES['event_image']['tmp_name'], $destination);
      if ($result) {
         $_POST['image'] = $image;
      } else {
         array_push($errors, "Image upload failed");
      }
   } else {
      array_push($errors, "Image is required");
   }

   $user_id = $_POST['user_id'] = $_SESSION['id'];
   $event_name = $_POST['event_name'];
   $limits = $_POST['limits'];
   $published = $_POST['published'] = "1";
   $address =  $_POST['address'];
   $start_time =  date('Y-m-d H:i', strtotime($_POST['start_time']));
   $end_time  = date('Y-m-d H:i', strtotime($_POST['end_time']));
   $vip =  $_POST['vip'];
   $ordinary =  $_POST['ordinary'];
   $img =  $_POST['image'] = $image;
   $add_info =  $_POST['add_info'];
   $age_id =  intval($_POST['age_id']);
   $city_id = intval($_POST['city_id']);
   $model->createEvent($event_name, $limits, $published, $address, $start_time, 
   $end_time, $vip, $ordinary, $img, $add_info, $age_id, $city_id, $user_id);

   

} 



if (isset($_POST['update-story'])) {
   $errors = validateStory($_POST);

   if (!empty($_FILES['image']['name'])) {
      $image = time() . '_' . $_FILES['image']['name'];
      $destination = "../uploads/".$image;

      $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
      if ($result) {
         $_POST['image'] = $image;
      } else {
         array_push($errors, "Image upload failed");
      }
   } else {
      array_push($errors, "Image is required");
   }

   if (count($errors) == 0) {
      unset($_POST['add-event']);
      $user_id = $_POST['user_id'] = $_SESSION['user'];
      $event_name = $_POST['event_name'];
      $address =  $_POST['address'];
      $limits = $_POST['limits'];
      $age_id =  intval($_POST['age_id']);
      $city_id = intval($_POST['city_id']);
      $start_time =  date('Y-m-d', strtotime($_POST['start_time']));
      $end_time  = date('Y-m-d', strtotime($_POST['end_time']));
      $ordinary =  $_POST['ordinary'];
      $vip =  $_POST['vip'];
      $add_info =  $_POST['add_info'];
      $published = $_POST['published'] = "1";
      $img =  $_POST['image'] = $image;

      /*$model->updatePost($event_name, $limits, $published, $address, $start_time, 
      $end_time, $vip, $ordinary, $img, $add_info,  $age_id, $city_id, $user_id);
      $_SESSION['message'] = "Story Updated Successfully";
      $_SESSION['type'] = "success";
      header("Location: ../../admin_author/view-posts.php");*/
   }

}


?>

